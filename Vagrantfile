# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  # Define the box name
  config.vm.box = "precise32"

  # Define the box url in case Vagrant needs to download it
  config.vm.box_url = "http://files.vagrantup.com/precise32.box"

  # Enable port forwarding
  config.vm.network :forwarded_port, host: 4567, guest: 80

  # Enable the bootstrap-script
  config.vm.provision :shell, :path => "bootstrap.sh"

  # Change virtualbox to allow for symlinks inside the vagrant folder
  config.vm.provider "virtualbox" do |v|
    v.customize ["setextradata", :id, "VBoxInternal2/SharedFoldersEnableSymlinksCreate/vagrant", "1"]
  end

end
