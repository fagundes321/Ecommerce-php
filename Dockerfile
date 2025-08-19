# Use an official PHP runtime
FROM php:8.2-apache
# Enable Apache modules
RUN a2enmod rewrite
# Install any extensions you need
RUN docker-php-ext-install mysqli pdo pdo_mysql
# Set the working directory to /var/www/html
WORKDIR /var/www/html
# Copy the source code in /www into the container at /var/www/html
COPY ../. .

# Instala dependências básicas
RUN apt-get update && apt-get install -y --no-install-recommends \
    ca-certificates \
    apt-transport-https \
    gnupg2 \
    curl \
    lsb-release \
    unzip \
    zip \
    git \
    nodejs \
    npm \
    nginx \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libaio-dev \
    alien

# Adiciona o repositório do PHP 8.0 (Sury)
RUN curl -fsSL https://packages.sury.org/php/apt.gpg | gpg --dearmor -o /usr/share/keyrings/sury.gpg \ 
    && echo "deb [signed-by=/usr/share/keyrings/sury.gpg] https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list



# Instalando o composer.
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
