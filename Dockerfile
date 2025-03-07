FROM php:8.0-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libonig-dev \
    && docker-php-ext-install zip mbstring

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalar PHPUnit globalmente
RUN composer global require phpunit/phpunit:^9.0 && \
    ln -s /root/.composer/vendor/bin/phpunit /usr/local/bin/phpunit

WORKDIR /app

# Copiar composer.json e composer.lock primeiro para aproveitar o cache
COPY composer.json ./
COPY phpunit.xml ./

# Instalar dependências
RUN composer install

# Copiar o restante dos arquivos do projeto
COPY . .

# Executar testes
CMD ["phpunit"]