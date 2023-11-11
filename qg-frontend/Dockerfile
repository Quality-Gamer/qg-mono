# Use uma imagem base com PHP 7.4 e Apache
FROM php:7.4-apache

# Defina o diretório de trabalho para /var/www/html
WORKDIR /var/www/html

# Atualize e instale as dependências necessárias (incluindo o Composer)
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/* \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copie o código do projeto Laravel para o contêiner
COPY qg-frontend/ .

# Instale as dependências do Laravel usando o Composer
RUN composer install

# Defina as permissões corretas para os diretórios de armazenamento e cache do Laravel
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Exponha a porta 80 para o servidor web
EXPOSE 80

# Inicie o servidor Apache
CMD ["apache2-foreground"]