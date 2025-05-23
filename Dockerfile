FROM php:8.3-apache

# Install necessary packages and PHP extensions
RUN apt-get update && apt-get install -y \
    openssh-server \
    git curl unzip zip libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip \
    && a2enmod rewrite \
    && apt-get clean

# Create SSH run directory
RUN mkdir /var/run/sshd

# Set root password
RUN echo 'root:rootpassword' | chpasswd

# Allow SSH password login
RUN sed -i 's/#PasswordAuthentication yes/PasswordAuthentication yes/' /etc/ssh/sshd_config

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Expose HTTP and SSH ports
EXPOSE 80 22

# Start SSH and Apache on container startup
CMD service ssh start && apache2-foreground