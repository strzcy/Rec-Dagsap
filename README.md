# Rec-Dagsap

### 1. Clone repository
git clone https://github.com/strzcy/Rec-Dagsap.git
<br>
cd Rec-Dagsap

### 2. Install dependencies
composer install

### 3. Copy environment
cp .env.example .env

### 4. Generate key
php artisan key:generate

### 5. Setup database di .env
DB_DATABASE=recruitment_dagsap
<br>
DB_USERNAME=root
<br>
DB_PASSWORD=

### 6. Jalankan migration & seeder
php artisan migrate:fresh

### 7. BUAT STORAGE LINK
php artisan storage:link

### 8. Install NPM (optional)
npm install
<br>
npm run build

### 9. Jalankan server
php artisan serve
