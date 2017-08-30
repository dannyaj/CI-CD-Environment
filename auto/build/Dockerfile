FROM ubuntu:17.04

RUN apt-get update
RUN apt-get install -y vim
RUN apt-get install -y apache2
RUN apt-get install -y php7.0

ADD code/* /var/www/html/

CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]

