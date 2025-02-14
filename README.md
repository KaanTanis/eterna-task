# E-Cafe Admin Panel

Bu proje, Laravel 11 ve Vue 3 kullanılarak geliştirilmiş bir panelipaneldirdir. Vue.js, Laravel'in yapısını bozmadan doğrudan `resources` dizini içerisinde entegre edilmiş ve Blade template engine ile uyumlu çalışacak şekilde kurgulanmıştır.

## Teknolojiler

- Laravel 11
- Vue 3
- Tailwind CSS 4
- Vite

## Özellikler

- Müşteri ve admin panelleri için ayrı Tailwind CSS yapılandırması
- Vue Router ile SPA (Single Page Application) yapısı
- Authentication sistemi
- Kategori yönetimi
- Ürün yönetimi

## Kurulum

1. Repo'yu klonlayın:
```bash
git clone [repo-url]
cd [proje-dizini]
```
2. Bağımlılıkları yükleyin:
```bash
composer install
npm install
```
3. SQLite veritabanını oluşturun:
```bash
touch database/database.sqlite
```
4. Ortam değişkenlerini ayarlayın:
```bash
cp .env.example .env
php artisan key:generate
```
5. Veritabanını hazırlayın:
```bash
php artisan migrate --seed
```
6. Asset'leri derleyin:
```bash
npm run build
```

## Geliştirme Notları
Bu bir demo projedir. Dolayısıyla; 

Zaman sıkıntısı nedeniyle işlevsellik taraflarında bazı kısımların eksik bırakılması gerekti.

Yine zaman sıkıntısı dolayısıyla tasarım aşamalarına çok fazla özenilmedi ve daha random ilerlenildi.

Yapılabilecekleri sunmak adına çalışma basit tutuldu.