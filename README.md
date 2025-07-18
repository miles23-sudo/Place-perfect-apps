![logo](https://github.com/user-attachments/assets/13f45d03-b9a0-4aa4-8cd5-332680d40c14)

# Place Perfect App

A web-based **augmented reality furniture simulation** tool for virtual home furnishing and spiritual _blessing_ of furniture - built specifically for **Our Lady of Lourdes College**.

Made with **Laravel**, **Livewire**, **TailwindCSS**, **AlpineJS**, and powered by **AR.js** for browser-based AR.

---

## User Roles

### Admin (Business Owner)

-   Authentication (Login/Logout)
-   Dashboard (Overview, Analytics & Reports)
-   Manage Products
-   Manage Product Categories
-   3D Model Upload & Management
-   Manage Orders
-   Customer Reviews
-   Notifications

### Customer

-   Authentication (Login/Logout)
-   Dashboard
-   Browse Product Catalog
-   Manage Account Settings

---

## Augmented Reality Feature

-   Uses **AR.js** to overlay 3D models on camera via WebAR
-   No mobile app required — works in the browser!
-   Lightweight, fast, and works on most modern smartphones.

---

## Tech Stack

| Layer        | Tech                                |
| ------------ | ----------------------------------- |
| Frontend     | Tailwind CSS, Alpine.js, Vanilla JS |
| Backend      | Laravel 10 + Livewire               |
| Database     | MySQL                               |
| AR Layer     | AR.js                               |
| Local Server | XAMPP                               |

---

## Authentication

-   Role-based access (Admin / Customer)
-   Manual password reset (no email reset)
-   User roles enforced via middleware

---

## Local Development Setup

```bash
# 1. Clone the repository
git clone https://github.com/JayDoesPHP/place-perfect-app.git
cd place-perfect-app

# 2. Install PHP dependencies
composer install

# 3. Install frontend assets
npm install && npm run dev

- error? 'vite' is not recognized as an internal or external command, operable program or batch file
- run:
npm install vite --save-dev

# 4. Copy .env and configure
cp .env.example .env
php artisan key:generate

# 5. Set up your DB
- edit .env with DB credentials
php artisan migrate

- Custom Command to Restart App
php artisan start

# 6. Create storage symlink
php artisan storage:link

# 7. Run the server
php artisan serve
```

Now open your browser and go to:  
[http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## Sample Credentials

### Admin Login

```
Email:    admin@admin.com
Password: password
```

### Customer Login

Email: (Check Database for any email with customer role)
Password: password

---

## ⚠️ Notes

-   **This project is not for sale**
-   For **academic/demo** purposes only (e.g. thesis)
-   Not optimized for production deployment (yet 😉)
