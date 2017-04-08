# Dépendences serveur

``` sh
apt-get install -y apache2 php5-fpm php5-mcrypt php5-mysql php5-gd php5-curl`
a2enmod mpm_event actions proxy_fcgi
service apache2 restart
```