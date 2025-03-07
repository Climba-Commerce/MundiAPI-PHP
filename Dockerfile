FROM php:8.0-cli

# Instalar dependências
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libonig-dev \
    && docker-php-ext-install zip mbstring

# Instalar Xdebug
RUN pecl install xdebug-3.1.6 \
    && docker-php-ext-enable xdebug

# Configurar Xdebug
RUN echo "xdebug.mode=coverage" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

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
RUN composer install --no-interaction --no-progress --prefer-dist

# Copiar o restante dos arquivos do projeto
COPY . .

# Criar diretório para relatórios de cobertura
RUN mkdir -p coverage && chmod -R 777 coverage

# Executar testes
CMD ["phpunit"]