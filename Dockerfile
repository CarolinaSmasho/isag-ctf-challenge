FROM registry.ce-isag.com/isag_ctf/php-custom

RUN docker-php-ext-install mysqli pdo pdo_mysql && \
    a2enmod rewrite

COPY app/views /var/www/html/

WORKDIR /bot

COPY package.json .
RUN npm install .

COPY bot/mybot2.js .

WORKDIR /

COPY start.sh .
RUN chmod +x ./start.sh

RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

CMD ["/start.sh"]
