# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|

  # virtualbox config
  config.vm.box = "precise64"
  config.vm.box_url = "http://files.vagrantup.com/precise64.box"

  # vmware fusion config
  config.vm.provider "vmware_fusion" do |v, o|
    o.vm.box = "precise64_vmware"
    o.vm.box_url = "http://files.vagrantup.com/precise64_vmware.box"
  end

  # vmware workstation config
  config.vm.provider "vmware_workstation" do |v, o|
    o.vm.box = "precise64_vmware"
    o.vm.box_url = "http://files.vagrantup.com/precise64_vmware.box"
  end

  # set the hostname
  config.vm.hostname = "yii-app"

  # enable port forwarding
  config.vm.network "forwarded_port", guest: 80, host: 1337

  # provision the vm
  config.vm.provision "shell", :path => "setup-puppet.sh"
  config.vm.provision "puppet" do |puppet|
    puppet.hiera_config_path = "hiera.yaml"
    puppet.module_path = "modules"
    puppet.temp_dir = "/vagrant/.tmp"
    #puppet.options = "--verbose --debug"
    puppet.working_directory = "/vagrant"
    puppet.facter = {
      "env" => "php",
    }
  end

  # set file permissions
  config.vm.synced_folder ".", "/vagrant", :mount_options => ["dmode=777", "fmode=666"]

end
