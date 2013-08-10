#!/usr/bin/env bash

# Install Apache
apt-get update
apt-get install -y apache2 libapache2-mod-rewrite libapache2-mod-php5
rm -rf /var/www
ln -fs /vagrant /var/www
a2enmod rewrite

# Install PHP
apt-get install -y php5 php5-curl php5-gd php5-mcrypt php5-mysql

# Install MySQL
echo mysql-server mysql-server/root_password select "vagrant" | debconf-set-selections
echo mysql-server mysql-server/root_password_again select "vagrant" | debconf-set-selections
apt-get install -y mysql-server-5.5 php5-mysql
mysql -u root -p vagrant -e "CREATE DATABASE yii_app;"

# Install node.js
apt-get install -y python-software-properties python g++ make
add-apt-repository ppa:chris-lea/node.js
apt-get update
apt-get install -y nodejs

# Install Grunt CLI globally and required node modules
npm install -g grunt-cli
cd /vagrant
npm install

# Install screen
apt-get install -y screen

# Run various Yii console tasks
php /vagrant/app/yiic migrate --interactive=false
php /vagrant/app/yiic environment dev

# Restart Apache
service apache2 restart