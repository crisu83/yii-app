# -*- mode: ruby -*-
# vi: set ft=ruby :

host_name        = "yii-app"
db_root_password = "root"
cpus             = 1
memsize          = 1024
forwarded_port   = 8080

Vagrant.configure("2") do |config|

  # Default configuration
  #config.ssh.forward_agent = true
  config.vm.box = "precise64"
  config.vm.box_url = "http://files.vagrantup.com/precise64.box"
  config.vm.host_name = host_name
  config.vm.network "forwarded_port", guest: 80, host: forwarded_port
  config.vm.synced_folder ".", "/vagrant", :mount_options => [
    "dmode=777",
    "fmode=666"
  ]

  # Oracle VirtualBox configuration
  config.vm.provider "virtualbox" do |v|
    v.customize [
        'modifyvm', :id,
        '--cpus', cpus,
        '--memory', memsize,
    ]
  end

  # VMWare Fusion configuration
  config.vm.provider "vmware_fusion" do |v, o|
    o.vm.box = "precise64_vmware"
    o.vm.box_url = "http://files.vagrantup.com/precise64_vmware.box"
    v.vmx["memsize"] = memsize
    v.vmx["numvcpus"] = cpus
  end

  # VMWare Workstation configuration
  config.vm.provider "vmware_workstation" do |v, o|
    o.vm.box = "precise64_vmware"
    o.vm.box_url = "http://files.vagrantup.com/precise64_vmware.box"
    v.vmx["memsize"] = memsize
    v.vmx["numvcpus"] = cpus
  end

  # Set up provisioning with Puppet
  config.vm.provision "shell", :path => "setup-puppet.sh"
  config.vm.provision "puppet" do |puppet|
    #puppet.options = "--verbost --debug"
    puppet.manifests_path = "manifests"
    puppet.manifest_file = "yii_app.pp"
    puppet.module_path = "modules"
    puppet.hiera_config_path = "manifests/hiera.yaml"
    puppet.working_directory = "/vagrant"
    puppet.facter = {
      "environment" => "lampn",
      "db_root_password" => db_root_password,
    }
  end

end
