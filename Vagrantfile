
Vagrant.configure("2") do |config|
 
  config.vm.box = "giacomopanattoni/magento2"
  config.vm.box_version = "1.0.0"
  config.vm.hostname = "laravel.it"
  config.vm.network :private_network, ip: "192.168.0.15"
  config.vm.synced_folder "../../PROGETTI/laravel.it/source/httpdocs", "/var/www/html",
	owner: "www-data", group: "www-data",
	create: true

  config.vm.provider "virtualbox" do |v|
    v.memory = 1024
    v.cpus = 3
  end 

end
