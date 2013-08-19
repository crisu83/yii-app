# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|

  # define the box name
  config.vm.box = "precise32"

  # define the box url in case Vagrant needs to download it
  config.vm.box_url = "http://files.vagrantup.com/precise32.box"

  # enable port forwarding
  config.vm.network :forwarded_port, host: 4567, guest: 80

  # enable the bootstrap-script
  config.vm.provision :shell, :path => "bootstrap.sh"

end
