============================
ext - commandline ter client 
============================

 * Author: Elmar Hinz <t3elmar@googlemail.com>
 * Homepage: http://t3elmar.github.com/Ext/
 * Version: 1.0.0
 * Stability: Alpha/Usable
 * Last update: 2013-03-18
 * OS: Unix, Mac, Linux, BSD
 * Dependencies: 
   * php > 5.3 with SOAP
   * https://github.com/t3elmar/Cool
   * https://github.com/etobi/Typo3ExtensionUtils
   * git (recommended for installation)

Installation
============

With git
--------

I suggest to use copy and paste, all at once.

```sh
  git clone https://github.com/t3elmar/Cool.git

  cd Cool/Modules

  git clone https://github.com/etobi/Typo3ExtensionUtils.git
  git clone https://github.com/t3elmar/Ext.git

  cd Ext/bin

  chmod +x ext
  ./ext install 
```

With wget and tar
-----------------

I suggest to use copy and paste, all at once.

```sh
wget https://github.com/t3elmar/Cool/tarball/master -O cool.tgz
tar xzf cool.tgz
mv t3elmar-* Cool
rm cool.tgz

cd Cool/Modules/

wget https://github.com/etobi/Typo3ExtensionUtils/tarball/master -O t3eu.tgz
tar xzf t3eu.tgz 
mv etobi-* Typo3ExtensionUtils
rm t3eu.tgz

wget https://github.com/t3elmar/Ext/tarball/master -O ext.tgz
tar xzf ext.tgz
mv t3elmar-* Ext
rm ext.tgz

cd Ext/bin

chmod +x ext
./ext install
```

Usage
=====

```sh
  ext description                          => get the description
  ext description 'my text here'           => set the description
  ext help                                 => this help
  ext install                              => support to install
  ext list                                 => list settings (alias show, info)
  ext property 'mykey'                     => get a property (alias get)
  ext property 'mykey' 'myvalue'           => set a property (alias set)
  ext status                               => get the status
  ext status 'alpha'                       => set the status to alpha
  ext ter                                  => nothing happens
  ext ter info 'ext_key'                   => get extension info
  ext ter info 'ext_key' 'xx.xx.xx'        => get extension info for version xx.xx.xx
  ext upload 'password'                    => upload extension
  ext upload 'password' 'upload comment'   => upload extension with new comment
  ext user                                 => get the TER username
  ext user 'myname'                        => set the TER username
  ext version                              => get the version
  ext version 'xx.xx.xx'                   => set the extension version xx.xx.xx
```

TODO
====

  * Add more TER features.
	* Test it on windows.
	* Document how to contribute modules.

Wanted
======

  * Testers
  * Issus
  * Pull requests
  * Modules, that extend the functionality 

 
Have fun!

Yours, Elmar



