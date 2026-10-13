# Hostinger Deployment Guide — Modern Jewellery House

This step-by-step guide explains how to deploy **Modern Jewellery House** onto **Hostinger Shared Hosting / Cloud Hosting / VPS** via hPanel.

---

## 📁 Your Database SQL File

Your ready-to-import MySQL database file has been generated and is located at:
- **`modern_jewellery_house.sql`** (Root directory)
- **`database/modern_jewellery_house.sql`** (Inside `database/` folder)

This file contains all tables, schema, relationships, and complete seeded data:
- ✅ Super Admin user (`admin@modernjewelleryhouse.com` / `Secret@12345`)
- ✅ Customer account (`elena@modernjewelleryhouse.com` / `Secret@12345`)
- ✅ All 5 luxury categories & 3 curated collections
- ✅ All 30 jewelry products (Haute Joaillerie & BlueStone Indian Ring Collection)
- ✅ 34 variants & inventory stock levels
- ✅ 60 product images
- ✅ Banners, FAQs, active coupons (`MAISON10`), and atelier settings

---

## 🚀 Step-by-Step Deployment Instructions on Hostinger

### Step 1: Create a MySQL Database in Hostinger hPanel
1. Log into your **Hostinger hPanel**.
2. Go to **Databases** > **Management** (or **MySQL Databases**).
3. Create a new database:
   - **Database Name**: e.g., `u123456789_mjh`
   - **Database Username**: e.g., `u123456789_admin`
   - **Password**: *Create a strong password and save it*
4. Click **Create**.

---

### Step 2: Import the SQL File in phpMyAdmin
1. In Hostinger hPanel under **Databases**, find your new database and click **Enter phpMyAdmin**.
2. Click the **Import** tab at the top.
3. Click **Choose File** and select **`modern_jewellery_house.sql`** from this project.
4. Leave settings at default (UTF-8, SQL format) and click **Import** (or **Go**).
5. All 39 tables and catalog data will be imported instantly!

---

### Step 3: Upload Project Files to Hostinger

#### Option A: Using Hostinger Git (Recommended)
1. In hPanel, go to **Advanced** > **GIT**.
2. Create a repository deployment:
   - **Repository URL**: `https://github.com/krishkr95/modernsjewellery.git`
   - **Branch**: `main`
   - **Install Directory**: `public_html`
3. Click **Create & Deploy**.

#### Option B: Using File Manager / ZIP
1. Compress the project folder into a `.zip` file (excluding `node_modules` and `.git`).
2. Open **File Manager** in hPanel.
3. Upload the `.zip` to `public_html` and **Extract** it.

> **Note on `.htaccess`**: A root `.htaccess` file has already been added to the project. It automatically redirects all domain visitors into the `public/` directory without exposing sensitive files.

---

### Step 4: Configure `.env` on Hostinger
1. In Hostinger **File Manager**, locate `.env` in your project folder (if hidden, toggle "Show Hidden Files" in File Manager settings, or copy `.env.example` to `.env`).
2. Edit `.env` with your Hostinger database and domain details:

```env
APP_NAME="Modern Jewellery House"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=u123456789_mjh
DB_USERNAME=u123456789_admin
DB_PASSWORD=your_hostinger_db_password

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=sync
FILESYSTEM_DISK=public

RAZORPAY_KEY_ID=rzp_test_luxuryhouse
RAZORPAY_KEY_SECRET=secret_luxuryatelier99
RAZORPAY_WEBHOOK_SECRET=whsec_luxuryatelier99
```

---

### Step 5: Create Storage Symlink & Permissions
If you have **SSH Access** on Hostinger:
```bash
cd public_html
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

If you **do NOT have SSH access**:
1. You can create a temporary route in `routes/web.php`:
   ```php
   Route::get('/symlink-storage', function () {
       \Illuminate\Support\Facades\Artisan::call('storage:link');
       return 'Storage symlink created successfully!';
   });
   ```
2. Visit `https://yourdomain.com/symlink-storage` once in your browser.
3. Remove or comment out that route afterwards.

---

### Step 6: Verify Frontend & Admin Access
1. Open `https://yourdomain.com` in your browser.
2. The homepage, navigation, collections, BlueStone catalog, and cart will be live with compiled Vite CSS/JS.
3. Access Admin Panel at: `https://yourdomain.com/login`
   - **Email**: `admin@modernjewelleryhouse.com`
   - **Password**: `Secret@12345`
