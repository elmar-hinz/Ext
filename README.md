============================
ext - commandline ter client 
============================

 * Author: Elmar Hinz <t3elmar@googlemail.com>
 * Homepage: http://t3elmar.github.com/Ext/
 * Version: 1.0.0
 * Stability: Alpha/Usable
 * Last update: 2013-03-18
 * OS: POSIX i.e. Mac OS X, Unix, Linux, BSD
 * Dependencies: 
   * php > 5.3 with SOAP
   * https://github.com/t3elmar/Cool
   * https://github.com/etobi/Typo3ExtensionUtils (from Tobias Liebig)
   * git (recommended for installation)

Installation
============

With git
--------

I suggest to use copy and paste, all at once.

```sh
# 1.) install Cool

git clone https://github.com/t3elmar/Cool.git

# 2.) install 2 modules

cd Cool/Modules

git clone https://github.com/etobi/Typo3ExtensionUtils.git
git clone https://github.com/t3elmar/Ext.git

# 3.) make ext executable and install an alias named ext

cd Ext/bin

chmod +x ext
./ext install 
```

The advantage with git is, that you can simply update with pull requests
and change back to an older version, if anything breaks.

With wget and tar
-----------------

I suggest to use copy and paste, all at once.

```sh
# 1.) install Cool

wget https://github.com/t3elmar/Cool/tarball/master -O cool.tgz
tar xzf cool.tgz
mv t3elmar-* Cool
rm cool.tgz

# 2.) install 2 modules

cd Cool/Modules/

wget https://github.com/etobi/Typo3ExtensionUtils/tarball/master -O t3eu.tgz
tar xzf t3eu.tgz 
mv etobi-* Typo3ExtensionUtils
rm t3eu.tgz

wget https://github.com/t3elmar/Ext/tarball/master -O ext.tgz
tar xzf ext.tgz
mv t3elmar-* Ext
rm ext.tgz

# 3.) make ext executable and install an alias named ext

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

Why to use it?
===============

Speed
-----

Once you are used to it, it is much faster, to upload extensions from commandline.

Scriptablity
------------

You can make the extension upload to TER a part of your testing and deployment scripts.

Independence
------------

You are independent form any installed TYPO3 instance.

In a typical vagrant development environments you run TYPO3 in virtual machines, 
while you edit the code directly on the host, that is mounted into the machines.
In example only the folder typ3conf is accessible from the host's side.
In that case you still can use ext to upload your extensions without having a 
TYPO3 installed on the host itself.

Synchronize your docs
---------------------

You can set the same version into your docs, which appears in TER. The classical
uploader sets the version during upload and your docs version is behind. With
ext the setting of the version and the upload are two different steps. 

You can render your docs with a private script in between with the selected version.

A command to install the version from ext_emconf.php into manual.sxw isn't available 
yet. It would be an idea for a module.

How to use it?
==============

In the first steps you store all requied values into the array of ext_emconf.php
by using the appropriate ext commands. You at least set your username for ter 
and the new version to use. 

Don't store you password into ext_empconf.php., stupid! 

In the final step you call the upload command with your password. 

Ext magically detects, when you are inside an extension, even if you work in 
a subdirectory of it. It knows the path to ext_emconf.php automatically. 

For scripting it means, that you must first `chdir` into the extension.

Example
-------

```sh
cd typo3conf/ext/myextension
ext show
ext user 'littleidiot'
ext version '1.12.7'
ext show
ext upload 'topsecret' 'just a bugfix release'
```

Now the user is set to ext_emfconf.php. The next time you can do:

```sh
ext show
ext version '1.12.8'
ext upload 'topsecret'
```

In this case the upload comment stays the same.


TODO
====

  * Interactive password input.
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



