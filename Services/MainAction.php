<?php namespace Ext;

class MainAction extends Action {

	public function handleArgument() {
		return $this->handleSubArgument();
	}

	public function usage() {
		return "ext help : this help";
	}

	public function help() {
		print $this->findAllUsages();
	}
	
	protected function findAllUsages() {
		$classes = get_declared_classes();
		$lines = array();
		foreach($classes as $class) {
			$ref = new \ReflectionClass($class);
			if($ref->isSubclassOf('Ext\ActionService') && !$ref->isAbstract()) {
				$o = $this->container->getInstance($class); 
				$lines = array_merge($lines, $this->beautifyText($o->usage()));
			}
		}
		sort($lines);
		$lines = chr(10).chr(10).join (chr(10), $lines).chr(10).chr(10);
		return $lines;
	}

	protected function beautifyText($text) {
		$lines = array_map('trim', explode(chr(10), trim($text)));
		$out = array();
		foreach($lines as $line) {
			$parts = array_map('trim', explode(':', $line, 2));
			if(count($parts) == 2)
				$out[] = sprintf('%-40s => %s', $parts[0], $parts[1]);
		}
		return $out;
	}

}

?>

