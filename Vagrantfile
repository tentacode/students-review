Vagrant.configure(2) do |config|
    config.vm.box = "tentacode/ynov-symfony"
    config.vm.box_version = "1.0"
    config.vm.network :forwarded_port, guest: 8000, host: 1337 # http
    config.vm.network :forwarded_port, guest: 3306, host: 13306 # mysql
    config.vm.network :forwarded_port, guest: 1080, host: 13380 # mailcatcher
    config.vm.network :private_network, ip: "192.168.33.42"
    config.vm.synced_folder ".", "/vagrant", id: "ynov-symfony", :nfs => true, :mount_options => ['nolock,vers=3,udp,noatime,actimeo=1']
end
