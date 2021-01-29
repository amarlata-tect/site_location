CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Requirements
 * Installation
 * Configuration
 * Functionality
 * Troubleshooting
 * Extend
 * Maintainers

INTRODUCTION
------------

The address module provides functionality to configure and display site address.


REQUIREMENTS
------------

No external module require.


INSTALLATION
------------

* Install as you would normally install a contributed Drupal module. Visit
   https://www.drupal.org/node/1897420 for further information.


CONFIGURATION
-------------

* Configure the module inside the Configuration » System » Site Location Settings.

* Direct access on "/admin/config/ln-address/settings" URL.


FUNCTIONALITY
-------------

* Configure site address and display in a block

* Configure "Site Location" block in theme (/admin/structure/block)

TROUBLESHOOTING
---------------

 * If the content does not display, check the following:

   - Does block--address-block.html.twig template is execute?

EXTEND
------

 * hook_theme for extending default template of Location Block.
 * Override default css libraries to change default UI/UX.

MAINTAINERS
-----------

* Self