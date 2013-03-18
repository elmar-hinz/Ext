===========================
ext - commandline TER client 
============================

 * Author: Elmar Hinz <t3elmar@googlemail.com>
 * Status: Alpha (but already usable)
 * Last update: 2013-03-18
 * OS: Unix, Mac
 * Dependencies: 

    * php > 5.3
    * etobi/Typo3ExtensionUtils 

Installation
============

::

  git clone https://github.com/t3elmar/Cool.git
  cd Cool/Modules
  git clone https://github.com/etobi/Typo3ExtensionUtils.git
  git clone https://github.com/t3elmar/Ext.git
  cd Ext/bin
  chmod +x ext
  ./ext install 

Usage
=====

::

  ext description                          => get the description
  ext description 'my text here'           => set the description
  ext help                                 => this help
  ext install                              => support to install
  ext list                                 => list settings (alias show, info)
  ext property mykey                       => get a property (alias get)
  ext property mykey myvalue               => set a property (alias set)
  ext status                               => get the status
  ext status alpha                         => set the status to alpha
  ext ter                                  => nothing happens
  ext ter info ext_key                     => get extension info
  ext ter info ext_key xx.xx.xx            => get extension info for version xx.xx.xx
  ext upload password                      => upload extension
  ext upload password 'upload comment'     => upload extension with new comment
  ext user                                 => get the TER username
  ext user myname                          => set the TER username
  ext version                              => get the version
  ext version xx.xx.xx                     => set the extension version xx.xx.xx

Wanted
======

  * Testers
  * Pull requests
  * Modules, that extend the functionality 

 


