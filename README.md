=============================
ext - command-line ter client 
=============================

 * Author: Elmar Hinz <t3elmar@googlemail.com>
 * Homepage: http://t3elmar.github.com/Ext/
 * Version: 1.4.x
 * Stability: Alpha/Usable
 * License: MIT
 * Last update: See [ChangeLog](https://github.com/t3elmar/Ext/blob/master/ChangeLog)
 * OS: POSIX i.e. Mac OS X, Unix, Linux, BSD
 * Dependencies: 
   * php > 5.3 with SOAP
   * https://github.com/t3elmar/Cool
   * https://github.com/etobi/Typo3ExtensionUtils (from Tobias Liebig)
   * git (recommended for installation)
 * The dependencies have their own licenses and are not part of this program
	
In short
========

```sh
cd typo3conf/ext/myextension
ext version   '1.2.3'
ext comment   'my upload comment'
ext user      'littleidiot'
ext upload    'mypassword'
```
... but there is a lot more ...

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

# 3.) make both executable and install an alias named ext

chmod +x Typo3ExtensionUtils/bin/t3xutils.phar
chmod +x Ext/bin/ext
Ext/bin/ext install 
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

# 3.) make both executable and install an alias named ext

chmod +x Typo3ExtensionUtils/bin/t3xutils.phar
chmod +x Ext/bin/ext
Ext/bin/ext install 
```

Usage overview
==============

```sh
ext comment                              => get the upload comment
ext comment 'my text here'               => set the upload comment
ext description                          => get the description
ext description 'my text here'           => set the description
ext help                                 => this help
ext install                              => support to install
ext property mykey                       => get a property (alias get)
ext property mykey myvalue               => set a property (alias set)
ext show                                 => show settings (alias info)
ext state                               => get the state
ext state alpha                         => set the state to alpha
ext ter                                  => nothing happens
ext ter info ext_key                     => get extension info
ext ter info ext_key xx.xx.xx            => get extension info for version xx.xx.xx
ext upload 'password'                    => upload extension
ext user                                 => get the TER username
ext user myname                          => set the TER username
ext version                              => get the version
ext version xx.xx.xx                     => set the extension version xx.xx.xx
```

Why to use it?
===============

Speed
-----

Once you are used to it, it is much faster, to upload extensions from command-line.

Scriptablity
------------

You can make the extension upload to TER a part of your testing and deployment scripts.

Independence
------------

You are independent form any installed TYPO3 instance.

In a typical vagrant development environments you run TYPO3 in virtual machines, 
while you edit the code directly on the host, that is mounted into the machines.
In example only the folder typ3conf is accessible from the host's side.
In that case you still can use `ext` to upload your extensions without having a 
TYPO3 installed on the host itself.

Synchronize your docs
---------------------

You can set the same version into your docs, which appears in TER. The classical
uploader sets the version during upload and your docs version is behind. With
`ext` the setting of the version and the upload are two different steps. 

You can render your docs with a private script in between with the selected version.

A command to install the version from `ext_emconf.php` into manual.sxw isn't available 
yet. It would be an idea for a module.

How does it work?
=================

The ter upload
--------------

It is important to understand, that `ext` stores the ter **user** name, 
the ter **version** and the ter upload **comment** into `ext_emconf.php` 
of the given extension.  Once all is prepared to your liking,
it is a short call to upload:

```sh
  ext upload 'password'
```

In this sense ext is also an editor of `ext_emconf.php` and you may use it 
to edit other properties.

Ext magically detects, when you are inside an extension, even if you work in 
a subdirectory of it. It knows the path to `ext_emconf.php` automatically. 
If you are not inside an extension, you get an error message. 

This behaviour is called **extension context awareness**.
For scripting it means, that you must first `cd` into the extension.

Other features
--------------

Features, that are not *extension context aware*, don't require to be inside an extension.
Examples are the commands to fetch general informations from TER
	
```sh
  ext ter info 'ext_key'
  ext ter info 'ext_key' 'xx.xx.xx'
```

How to use it?
==============

Example of an upload session
----------------------------

```sh
cd typo3conf/ext/myextension
ext show
ext user 'littleidiot'
ext version '1.12.7'
ext show
ext comment 'just a bugfix release'
ext upload 'topsecret'
```

Now the user is set to `ext_emconf.php`. The next time you can do:

```sh
ext version '1.12.8'
ext upload 'topsecret'
```

In this case the upload comment stays the same.

Mind to use singlequotes, wherever you have special characters 
or whitespace in your strings, especially for the password.

TODO
====

  * Document how to contribute modules.
  * Interactive password input.
  * Add more TER features.
  * Add extension mangager features.
  * Test it on windows.
	
Success stories
===============

Did you manage to get `ext` running?

Contribute your success story: https://github.com/t3elmar/Ext/wiki/Success-Stories

Design goals
============

* MIT license - much freedom
* Independence from T3 core libraries
* Small footprint
* Modular system to enable contribution and customization
* Human orientated interface free of hypen pararmeters

Wanted
======

  * Testers
  * Issus
  * Pull requests
  * Modules, that extend the functionality 

 
Thank you for supporting `ext`. Have fun with it!

Yours, Elmar



