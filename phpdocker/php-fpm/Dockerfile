FROM ubuntu:18.04
ENV DEBIAN_FRONTEND=noninteractive
USER $USER_NAME
# terminal colors with xterm
ENV TERM xterm
# set the zsh theme
ENV ZSH_THEME agnoster

WORKDIR "/app"
EXPOSE 80

RUN apt-get update -qy \
&& apt-get install software-properties-common -y \
&& add-apt-repository ppa:ondrej/php -y \
&& apt-get update -qy \
&& apt install -qy \
# Os module
zsh \
nano \
curl \
git \
unzip \
apache2 \
memcached \
ffmpeg \
libmemcached-tools \
#PHP
php7.4 \
libapache2-mod-php \
# PHP lib
php7.4-memcached \
php7.4-dom \
php7.4-curl \
php7.4-xml \
php7.4-cli \
php7.4-mbstring

#Install composer
RUN cd ~ \
&& curl -sS https://getcomposer.org/installer -o composer-setup.php \
&& php composer-setup.php --install-dir=/usr/local/bin --filename=composer

# ZSH
CMD [ "zsh" ]
RUN sh -c "$(curl -fsSL https://raw.githubusercontent.com/ohmyzsh/ohmyzsh/master/tools/install.sh)"

#Install project
CMD composer install \
&& service memcached start \
&& apachectl -D FOREGROUND
