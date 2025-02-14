# E-Cafe Admin Panel

Bu proje, Laravel 11 ve Vue 3 kullanılarak geliştirilmiş bir paneldir. Vue.js, Laravel'in yapısını bozmadan doğrudan `resources` dizini içerisinde entegre edilmiş ve Blade template engine ile uyumlu çalışacak şekilde kurgulanmıştır.

## Teknolojiler

- Laravel 11
- Vue 3 (pinia, axios, toast)
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
2.1 Bağımlılıkları yükleyin:
```bash
cd /resources/admin
npm install
npm run build
```
3. SQLite veritabanını oluşturun:
```bash
touch database/database.sqlite
```
4. Ortam değişkenlerini ayarlayın:
```bash
cp .env.example .env
php artisan key:generate
php artisan storage:link
```
5. Veritabanını hazırlayın:
```bash
php artisan migrate --seed
```
6. Asset'leri derleyin:
```bash
npm run build
```
7. Bilgiler
```bash
Admin Paneli: /admin
E-posta: test@example.com
Şifre: 12345678
```

## Geliştirme Notları
Bu bir demo projedir. Dolayısıyla; 

Zaman sıkıntısı nedeniyle işlevsellik taraflarında bazı kısımların eksik bırakılması gerekti.

Yine zaman sıkıntısı dolayısıyla tasarım aşamalarına çok fazla özenilmedi ve daha random ilerlenildi.

Yapılabilecekleri sunmak adına çalışma basit tutuldu.

### İletişim
- +90 544 237 3323
- [E-Mail](mailto:kt@kaantanis.com)