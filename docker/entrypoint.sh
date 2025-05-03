#!/bin/sh
set -e

# Initialize storage directory if empty
if [ ! "$(ls -A /var/www/storage)" ]; then
  echo "Initializing storage directory..."
  cp -R /var/www/storage-init/. /var/www/storage
  chown -R www-data:www-data /var/www/storage
fi

# Remove storage-init directory to save space
rm -rf /var/www/storage-init

# Create a symlink if it doesn't exist
if [ ! -e /var/www/public/storage ]; then
  echo "Creating storage symlink..."
  cd /var/www && php artisan storage:link
fi

# Run Laravel migrations
echo "Running database migrations..."
php artisan migrate --force

# Optimize Laravel application for production
echo "Optimizing Laravel application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Publish vendor assets
echo "Publishing vendor assets..."
php artisan sweetalert:publish

# Set proper permissions
echo "Setting permissions..."
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Create a script to periodically fix permissions and run it in background
cat > /usr/local/bin/fix-permissions.sh << 'EOF'
#!/bin/sh
while true; do
  find /var/www/storage -type d -exec chmod 755 {} \;
  find /var/www/storage -type f -exec chmod 644 {} \;
  chown -R www-data:www-data /var/www/storage
  sleep 300  # Run every 5 minutes
done
EOF

chmod +x /usr/local/bin/fix-permissions.sh
/usr/local/bin/fix-permissions.sh &

# Run the default command (supervisord)
exec "$@"