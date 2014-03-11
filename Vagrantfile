# -*- mode: ruby -*-
# vi: set ft=ruby :

hostname    = 'yii-app'
domain      = 'example.com'
ip          = "192.168.50.4"
cpus        = 1
ram         = 1024

Vagrant.configure("2") do |config|

  # Oracle VirtualBox config (default)
  config.vm.box = "precise64"
  config.vm.box_url = "http://files.vagrantup.com/precise64.box"

  config.vm.provider "virtualbox" do |v|
    v.name = "my_vm"
    v.customize [
        'modifyvm', :id,
        '--name', hostname,
        '--cpus', cpus,
        '--memory', ram,
        '--natdnshostresolver1', 'on',
        '--natdnsproxy1', 'on'
    ]
  end

  # VMWare Fusion config
  config.vm.provider "vmware_fusion" do |v, o|
    o.vm.box = "precise64_vmware"
    o.vm.box_url = "http://files.vagrantup.com/precise64_vmware.box"
  end

  # VMWare Workstation config
  config.vm.provider "vmware_workstation" do |v, o|
    o.vm.box = "precise64_vmware"
    o.vm.box_url = "http://files.vagrantup.com/precise64_vmware.box"
  end

  # Common settings
  # -- Forward port, set ip, forward SSH agent, set file permissions
  config.vm.network "forwarded_port", guest: 80, host: 8080
  config.vm.network :private_network, ip: ip
  config.ssh.forward_agent = true
  config.vm.synced_folder ".", "/vagrant", :mount_options => [
      'dmode=777',
      'fmode=666'
  ]

  # Provision the VM with Puppet
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

end
