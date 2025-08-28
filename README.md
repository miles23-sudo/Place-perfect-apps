![logo](https://github.com/user-attachments/assets/13f45d03-b9a0-4aa4-8cd5-332680d40c14)

# Place Perfect App

A web-based **augmented reality furniture simulation** tool for virtual home furnishing.

Built with **Laravel**, **Livewire**, **TailwindCSS**, **AlpineJS**, and powered by **Model Viewer** for browser-based AR.

---

## User Roles

### Admin (Business Owner)

- Authentication (Login/Logout)
- Dashboard (Overview, Analytics & Reports)
- Product Management
- Product Category Management
- 3D Model Upload & Management
- Order Management
- Customer Reviews
- Notifications

### Customer

- Authentication (Login/Logout)
- Dashboard
- Browse Product Catalog
- Account Settings Management

---

## Augmented Reality Feature

- Uses **Model Viewer** to overlay 3D models on camera via WebAR
- No mobile app required - works directly in the browser
- Lightweight, fast, and compatible with most modern smartphones

---

## Tech Stack

| Layer        | Technology                          |
| ------------ | ----------------------------------- |
| Frontend     | Tailwind CSS, Alpine.js, Vanilla JS |
| Backend      | Laravel 11 + Livewire               |
| Database     | MySQL                               |
| AR Layer     | Model Viewer                        |
| Local Server | XAMPP                               |

---

## Local Development Setup

### 1. Clone the repository

```bash
git clone https://github.com/arxjei/place-perfect-app.git
cd place-perfect-app
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install frontend dependencies

```bash
npm install && npm run dev
```

**Troubleshooting:**
- If you encounter `'vite' is not recognized as an internal or external command` error:
  ```bash
  npm install vite --save-dev
  ```

- For mobile setup with Google API issues, stop the npm server (`Ctrl+C`) and run:
  ```bash
  npm run build
  ```

### 4. Environment configuration

```bash
cp .env.example .env
php artisan key:generate
```

### 5. Database setup

Edit `.env` with your database credentials, then run:

```bash
php artisan migrate
```

### 6. Create storage symlink

```bash
php artisan storage:link
```

### 7. Start the application

For local computer:
```bash
php artisan serve
```

For mobile testing:
```bash
php artisan serve:mobile
```

**Note:** Disable any DNS blockers or VPN when testing on mobile.

Custom restart command:
```bash
php artisan start
```

Access the application at: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## Important Setup Notes

> **Before using the application:**
> - Configure system settings to avoid conflicts in shipping, distance calculations, and order management
> - Set up required environment configurations such as Resend and Google Maps API

---

## Sample Credentials

### Admin Login
```
Email:    admin@admin.com
Password: password
```

### Customer Login
```
Email:    (Check database for any email with customer role)
Password: password
```

---

## Important Notes

- **This project is not for sale**
- For **academic/demo** purposes only (e.g., thesis projects)
- Not optimized for production deployment