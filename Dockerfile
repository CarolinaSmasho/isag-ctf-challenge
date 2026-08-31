FROM php:8.2-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql && \
    a2enmod rewrite

# Install Node.js 20 from nodesource
RUN apt-get update && \
    apt-get install -y curl ca-certificates gnupg && \
    mkdir -p /etc/apt/keyrings && \
    curl -fsSL https://deb.nodesource.com/gpgkey/nodesource-repo.gpg.key | gpg --dearmor -o /etc/apt/keyrings/nodesource.gpg && \
    echo "deb [signed-by=/etc/apt/keyrings/nodesource.gpg] https://deb.nodesource.com/node_20.x nodistro main" > /etc/apt/sources.list.d/nodesource.list && \
    apt-get update && \
    apt-get install -y nodejs && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Install minimal dependencies for chromium headless
RUN apt-get update && \
    apt-get install -y chromium && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

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
