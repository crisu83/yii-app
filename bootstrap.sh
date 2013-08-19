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
sudo apt-get install -y libapache2-mod-rewrite
sudo apt-get install -y libapache2-mod-php5

# remove default webroot
sudo rm -rf /var/www

# symlink project as webroot
sudo ln -fs /vagrant/web /var/www

# setup hosts file
VHOST=$(cat <<EOF
<VirtualHost *:80>
  DocumentRoot "/var/www"
  ServerName localhost
  <Directory "/var/www">
    AllowOverride All
  </Directory>
</VirtualHost>
EOF
)
echo "${VHOST}" > /etc/apache2/sites-enabled/default

# enable apache rewrite module
sudo a2enmod rewrite

# --- php ---

# install packages
sudo apt-get install -y php5
sudo apt-get install -y php5-curl
sudo apt-get install -y php5-gd
sudo apt-get install -y php5-mcrypt
sudo apt-get install -y php5-mysql
sudo apt-get install -y pdo-mysql

# --- mysql ---

# install packages
echo mysql-server mysql-server/root_password select "yii_app" | debconf-set-selections
echo mysql-server mysql-server/root_password_again select "yii_app" | debconf-set-selections
sudo apt-get install -y mysql-server-5.5

# create database
mysql -u "root" -p "yii_app" -e "CREATE DATABASE yii_app;"

# --- node.js ---

# install node.js dependencies
sudo apt-get install -y python g++ make

# add node.js repository
add-apt-repository ppa:chris-lea/node.js
sudo apt-get update

# install packages
sudo apt-get install -y nodejs

# install grunt.js
npm install -g grunt-cli

# install local npm packages
cd /vagrant && npm install --no-bin-links

# --- yii ---

# run database migrations
php /vagrant/app/yiic migrate --interactive=false

# enable the development environment
php /vagrant/app/yiic environment dev

# --- restart apache ---

sudo service apache2 restart