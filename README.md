<h5 align="center">SISTEM PENGAJUAN PEMBELIAN BARANG</h5>

## Install

1. **Clone Repository**

```bash
git clone hhttps://github.com/Alvi19/purchases.git
cd purchases
composer install
npm install / yarn install
cp .env.example .env
```

2. **Buka `.env` lalu ubah baris berikut sesuai dengan databasemu yang ingin dipakai**

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=username_database
DB_PASSWORD=password_database
```

3. **Instalasi website**

```bash
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
npm run dev / yarn dev
```

4. **Jalankan website**

```bash
php artisan serve
```

## Author

-   Instagram : <a href="https://www.instagram.com/alvirdh/"> alvirdh</a>
-   LinkedIn : <a href="https://www.linkedin.com/in/mohalviridho/"> Moh Alvi Ridho</a>

## License

-   Copyright © 2024 Moh Alvi Ridho.

## Kontak

-   Email : <a href="mailto:mohalviridho.com">mohalviridho@gmail.com</a>.
-   Whatsapp : <a href="https://wa.me/089699759595">089699759595</a>.
