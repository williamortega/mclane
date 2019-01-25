# McLane

The initial project of McLane with Magento 2.

## NGINX

Steps to set up local nginx file:

- On local config (SITE.conf) add below code:
```sh
# Default settings to multisite.
map $http_host $MAGE_RUN_CODE {
	default '';
    warehouse.mclane.local warehouse;
    delivery.mclane.local direct_delivery;
	kits.mclane.local kits;
}

server {
    listen 80;
    listen 443 ssl;
    server_name mclane.local warehouse.mclane.local delivery.mclane.local kits.mclane.local;
    set $MAGE_ROOT PATH_TO_SITE; # For laragon windows: "C:/laragon/www/mclane/";
    include "PATH_TO_SITE/nginx.conf"; # For laragon windows: C:/laragon/www/mclane/nginx.conf";
}
```

