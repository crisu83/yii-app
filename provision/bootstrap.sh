#!/usr/bin/env bash

# download the package lists from the repositories
sudo apt-get update

# --- miscellaneous ----

sudo apt-get install -y python-software-properties
sudo apt-get install -y curl
sudo apt-get install -y git-core
sudo apt-get install -y screen
sudo apt-get install -y vim

# --- apache ---

# install packages
sudo apt-get install -y apache2

# remove default webroot
sudo rm -rf /var/www

# symlink project as webroot
sudo ln -fs /vagrant/web /var/www

# setup hosts
sudo cp /vagrant/provision/sites /etc/apache2/sites-available/default

# enable apache modules
sudo a2enmod rewrite
sudo a2enmod setenvif
sudo a2enmod autoindex
sudo a2enmod deflate
sudo a2enmod filter
sudo a2enmod headers
sudo a2enmod expires

# --- php ---

# install php 5.4
sudo add-apt-repository ppa:ondrej/php5-oldstable
sudo apt-get update
sudo apt-get install -y php5

# install php packages
sudo apt-get install -y php5-curl
sudo apt-get install -y php5-gd
sudo apt-get install -y php5-mcrypt
sudo apt-get install -y php5-mysql
sudo apt-get install -y php-apc

# --- mysql ---

# install packages
echo mysql-server mysql-server/root_password select "yii_app" | debconf-set-selections
echo mysql-server mysql-server/root_password_again select "yii_app" | debconf-set-selections
sudo apt-get install -y mysql-server-5.5

# create database
mysql -uroot -pyii_app -e "CREATE DATABASE IF NOT EXISTS `yii_app` CHARACTER SET utf8 COLLATE utf8_general_ci;"

# --- sendmail ---

sudo apt-get install -y sendmail
sudo sendmailconfig

# --- node.js ---

# install node.js dependencies
sudo apt-get install -y python g++ make

# add node.js repository
sudo add-apt-repository ppa:chris-lea/node.js
sudo apt-get update

# install packages
sudo apt-get install -y nodejs

# install grunt.js
sudo npm install -g grunt-cli

# install local npm packages
cd /vagrant && sudo npm install --no-bin-links

# --- composer ---

cd /vagrant && sudo curl -sS https://getcomposer.org/installer | php

# --- yii ---

# run database migrations
sudo php /vagrant/console/yiic migrate --interactive=false

# enable the development environment
sudo php /vagrant/console/yiic environment dev

# --- restart apache ---

sudo service apache2 restart