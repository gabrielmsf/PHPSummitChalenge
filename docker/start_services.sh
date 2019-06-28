#! /bin/sh -ex

composer install

tail -f /var/log/syslog
