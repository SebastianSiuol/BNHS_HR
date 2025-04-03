# Use a multi-stage build to reduce image size

# Stage 1: Build assets
FROM node:18-alpine AS build-stage

WORKDIR /app

# Copy only necessary files to improve build cache efficiency
COPY package.json package-lock.json ./
RUN npm install

COPY . .
RUN npm run build

# Stage 2: Final application setup
FROM richarvey/nginx-php-fpm:3.1.6

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Copy built assets from the previous stage
COPY --from=build-stage /app/public/build public/build

# Install system dependencies
RUN apk add --no-cache npm \
    && rm -rf /var/cache/apk/*

# Image configuration
ENV SKIP_COMPOSER 1 \
    WEBROOT /var/www/html/public \
    PHP_ERRORS_STDERR 1 \
    RUN_SCRIPTS 1 \
    REAL_IP_HEADER 1 \
    APP_ENV production \
    APP_DEBUG false \
    LOG_CHANNEL stderr \
    COMPOSER_ALLOW_SUPERUSER 1

CMD ["/start.sh"]
