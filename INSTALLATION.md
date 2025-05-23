# Panduan Instalasi Website SinyalTrading

## Persyaratan Sistem
- PHP 8.1 atau lebih tinggi
- MySQL 5.7 atau lebih tinggi
- Composer
- Node.js dan NPM (untuk kompilasi aset)
- Web server (Apache/Nginx)

## Langkah-langkah Instalasi

### 1. Persiapan Server
Pastikan server Anda memiliki semua persyaratan sistem yang diperlukan. Anda dapat menginstal paket yang diperlukan dengan perintah berikut (untuk Ubuntu):

```bash
sudo apt update
sudo apt install php8.1 php8.1-mbstring php8.1-xml php8.1-curl php8.1-mysql php8.1-zip unzip composer mysql-server apache2
```

### 2. Konfigurasi Database
1. Buat database baru di MySQL:
```bash
mysql -u root -p
CREATE DATABASE sinyaltrading;
CREATE USER 'sinyaltrading_user'@'localhost' IDENTIFIED BY 'password_anda';
GRANT ALL PRIVILEGES ON sinyaltrading.* TO 'sinyaltrading_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

2. Import skema database:
```bash
mysql -u sinyaltrading_user -p sinyaltrading < database_schema.sql
```

### 3. Konfigurasi Aplikasi
1. Ekstrak file zip ke direktori web server Anda:
```bash
unzip sinyaltrading.zip -d /var/www/html/sinyaltrading
cd /var/www/html/sinyaltrading
```

2. Salin file .env.example menjadi .env dan sesuaikan konfigurasi:
```bash
cp .env.example .env
```

3. Edit file .env dan sesuaikan konfigurasi database:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sinyaltrading
DB_USERNAME=sinyaltrading_user
DB_PASSWORD=password_anda
```

4. Instal dependensi PHP:
```bash
composer install
```

5. Generate kunci aplikasi:
```bash
php artisan key:generate
```

6. Jalankan migrasi database (opsional, jika Anda belum mengimpor skema database):
```bash
php artisan migrate
```

7. Instal dependensi JavaScript dan kompilasi aset:
```bash
npm install
npm run dev
```

8. Atur izin direktori:
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### 4. Konfigurasi Web Server

#### Untuk Apache:
1. Buat file konfigurasi virtual host baru:
```bash
sudo nano /etc/apache2/sites-available/sinyaltrading.conf
```

2. Tambahkan konfigurasi berikut:
```
<VirtualHost *:80>
    ServerName sinyaltrading.com
    ServerAlias www.sinyaltrading.com
    DocumentRoot /var/www/html/sinyaltrading/public
    
    <Directory /var/www/html/sinyaltrading/public>
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/sinyaltrading_error.log
    CustomLog ${APACHE_LOG_DIR}/sinyaltrading_access.log combined
</VirtualHost>
```

3. Aktifkan virtual host dan modul rewrite:
```bash
sudo a2ensite sinyaltrading.conf
sudo a2enmod rewrite
sudo systemctl restart apache2
```

#### Untuk Nginx:
1. Buat file konfigurasi server baru:
```bash
sudo nano /etc/nginx/sites-available/sinyaltrading
```

2. Tambahkan konfigurasi berikut:
```
server {
    listen 80;
    server_name sinyaltrading.com www.sinyaltrading.com;
    root /var/www/html/sinyaltrading/public;
    
    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";
    
    index index.php;
    
    charset utf-8;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }
    
    error_page 404 /index.php;
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
    
    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

3. Aktifkan konfigurasi dan restart Nginx:
```bash
sudo ln -s /etc/nginx/sites-available/sinyaltrading /etc/nginx/sites-enabled/
sudo systemctl restart nginx
```

### 5. Konfigurasi Cron Job (Opsional)
Untuk fitur terjadwal, tambahkan cron job berikut:
```bash
crontab -e
```

Tambahkan baris berikut:
```
* * * * * cd /var/www/html/sinyaltrading && php artisan schedule:run >> /dev/null 2>&1
```

### 6. Konfigurasi Queue Worker (Opsional)
Untuk fitur antrian, jalankan perintah berikut:
```bash
php artisan queue:work --daemon
```

Untuk menjalankan queue worker sebagai layanan, buat file systemd:
```bash
sudo nano /etc/systemd/system/sinyaltrading-queue.service
```

Tambahkan konfigurasi berikut:
```
[Unit]
Description=SinyalTrading Queue Worker
After=network.target

[Service]
User=www-data
Group=www-data
Restart=always
ExecStart=/usr/bin/php /var/www/html/sinyaltrading/artisan queue:work --daemon

[Install]
WantedBy=multi-user.target
```

Aktifkan dan jalankan layanan:
```bash
sudo systemctl enable sinyaltrading-queue.service
sudo systemctl start sinyaltrading-queue.service
```

## Akses Website
Setelah instalasi selesai, Anda dapat mengakses website SinyalTrading melalui browser dengan URL:
- http://sinyaltrading.com (jika Anda telah mengkonfigurasi domain)
- http://alamat_ip_server (jika Anda belum mengkonfigurasi domain)

## Akun Default
- Admin: admin@sinyaltrading.com / password: admin123
- User: user@sinyaltrading.com / password: user123

## Dukungan
Jika Anda mengalami masalah selama instalasi atau penggunaan website, silakan hubungi tim dukungan kami di support@sinyaltrading.com.
