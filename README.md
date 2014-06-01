yii-app
=======

[![Latest Stable Version](https://poser.pugx.org/crisu83/yii-app/v/stable.png)](https://packagist.org/packages/crisu83/yii-app)
[![Build Status](https://travis-ci.org/crisu83/yii-app.png)](https://travis-ci.org/crisu83/yii-app)

A great way to start building your web application with the Yii PHP framework.

## Setup

 * Set up Git by following the instructions [here](https://help.github.com/articles/set-up-git).
 * Download and install Composer by following the instructions [here](http://getcomposer.org/download/).
 * Run `composer create-project crisu83/yii-app [APP-NAME]` and composer will create the project for you.
 * Browse through the `composer.json` and remove the dependencies you don't need.
 * Download and install Node.js by following the instructions here [here](https://github.com/joyent/node/wiki/Installing-Node.js-via-package-manager).
 * Run `npm install` to download the Node.js dependencies.
 * Update the configurations in `app/config` to suit your needs.
 * Start Grunt by running `grunt` and it will compile your LESS and deploy your JavaScript files.
 * Run `yiic environment dev` to activate the development environment.
 * You're done! Navigate to `web/index.php` to see your application.

## Setup using Vagrant (optional)

 * Download and install Vagrant by following the instructions [here](http://downloads.vagrantup.com/)
 * Download VirtualBox 4.2.12 [here](http://download.virtualbox.org/virtualbox/4.2.12/) and run the installer
 * If you are using Windows you need to run VirtualBox as an Administrator
 * Set up Git by following the instructions [here](https://help.github.com/articles/set-up-git).
 * Download and install Composer by following the instructions [here](http://getcomposer.org/download/).
 * Run `composer create-project crisu83/yii-app [APP-NAME]` and composer will create the project for you.
 * Run `vagrant up` to set up your development environment.
 * You're done! Navigate to `http://localhost:8080/index.php` to see your application.


For more information on Composer, Grunt and Vagrant:

* [Composer documentation](http://getcomposer.org/doc/)
* [Grunt documentation](http://gruntjs.com/getting-started)
* [Vagrant documentation](http://docs.vagrantup.com/v2/)

## Extensions

The following extensions are part of yii-app:

 * Audit https://github.com/nordsoftware/yii-audit
 * Auth https://github.com/Crisu83/yii-auth
 * Debug toolbar https://github.com/malyshev/yii-debug-toolbar
 * Console tools https://github.com/Crisu83/yii-consoletools
 * Emailer https://github.com/nordsoftware/yii-emailer
 * File manager https://github.com/Crisu83/yii-filemanager
 * Image manager https://github.com/Crisu83/yii-imagemanager
 * Password https://github.com/phpnode/YiiPassword
 * Seo https://github.com/Crisu83/yii-seo
 * Yiistrap https://github.com/Crisu83/yiistrap

Please consult the extension documentation for further information.
