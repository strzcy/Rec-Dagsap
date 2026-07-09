# Rec-Dagsap

### Clone repository
git clone https://github.com/strzcy/Rec-Dagsap.git
<br>
cd Rec-Dagsap

### Install dependencies
composer install

### Copy environment
cp .env.example .env

### Generate key
php artisan key:generate

### Setup database di .env
DB_DATABASE=recruitment_dagsap
<br>
DB_USERNAME=root
<br>
DB_PASSWORD=

### Jalankan migration & seeder
php artisan migrate:fresh

### BUAT STORAGE LINK
php artisan storage:link

### Install NPM (optional)
npm install
<br>
npm run build

# Jalankan server
php artisan serve
