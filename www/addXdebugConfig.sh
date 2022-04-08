export PHP_IDE_CONFIG="serverName=local"
cp -p /usr/local/etc/php/php.ini /usr/local/etc/php/php.ini-
echo "" >> /usr/local/etc/php/php.ini
echo 'xdebug.remote_enable=1' >> /usr/local/etc/php/php.ini
echo 'xdebug.remote_host=192.168.2.153' >> /usr/local/etc/php/php.ini
echo 'xdebug.remote_connect_back=false' >>  /usr/local/etc/php/php.ini
echo 'xdebug.remote_port=9003' >>  /usr/local/etc/php/php.ini
echo 'xdebug.remote_handler=dbgp' >>  /usr/local/etc/php/php.ini
echo 'xdebug.remote_autostart=1' >>  /usr/local/etc/php/php.ini
echo 'xdebug.remote_mode=req' >>  /usr/local/etc/php/php.ini
echo 'xdebug.idekey=PHPSTORM' >>  /usr/local/etc/php/php.ini
echo 'xdebug.remote_log=/tmp/xdebug.log' >> /usr/local/etc/php/php.ini
echo 'xdebug.remote_log_level=7' >> /usr/local/etc/php/php.ini