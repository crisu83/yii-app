hiera_include('classes')

# APT update
exec { 'apt-update':
  command => '/usr/bin/apt-get update'
}

# Default packages
$default_packages = hiera('default_packages')
package { $default_packages:
  ensure => installed,
}

# Apache
$vhosts = hiera('vhosts')
create_resources(apache::vhost, $vhosts)

# PHP modules
$php_modules = hiera('php_modules')
create_resources(php::module, $php_modules)

php::conf { ['mysqli', 'pdo', 'pdo_mysql']:
  require => Package['php-mysql'],
# notify  => Service['apache'],
}

# MySQL
hiera_include('db_classes')

$databases = hiera('databases')
create_resources(mysql_database, $databases)

/*
mysql_user { 'root@%':
  ensure                   => 'present',
  max_connections_per_hour => '0',
  max_queries_per_hour     => '0',
  max_updates_per_hour     => '0',
  max_user_connections     => '0',
  password_hash => mysql_password('root')
}
mysql_grant { 'root@%/*.*':
  ensure     => 'present',
  options    => ['GRANT'],
  privileges => ['ALL'],
  table      => '*.*',
  user       => 'root@%',
}
*/

# Node.js
$npms_to_install = hiera('npms_to_install')
package { $npms_to_install:
  ensure => present,
  provider => 'npm',
  require => Package['nodejs']
}