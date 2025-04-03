FROM richarvey/nginx-php-fpm:3.1.6

# Set the working directory
WORKDIR /var/www/html

# Update Alpine packages and install npm (this layer will be cached unless apk changes)
RUN apk update && apk add --no-cache npm

# Copy package.json and package-lock.json first for better caching
COPY package.json package-lock.json ./

# Install NPM dependencies separately (cached if package.json hasn't changed)
RUN npm install

# Copy the rest of the application files
COPY . .

# Build Vite assets
RUN npm run build

# Environment configuration
ENV SKIP_COMPOSER=1 \
    WEBROOT=/var/www/html/public \
    PHP_ERRORS_STDERR=1 \
    RUN_SCRIPTS=1 \
    APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr \
    COMPOSER_ALLOW_SUPERUSER=1

CMD ["/start.sh"]
