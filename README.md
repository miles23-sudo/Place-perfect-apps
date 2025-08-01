![logo](https://github.com/user-attachments/assets/13f45d03-b9a0-4aa4-8cd5-332680d40c14)

# Place Perfect App

A web-based **augmented reality furniture simulation** tool for virtual home furnishing of furniture.

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
-   No mobile app required - works in the browser!
-   Lightweight, fast, and works on most modern smartphones.

---

## Tech Stack

| Layer        | Tech                                |
| ------------ | ----------------------------------- |
| Frontend     | Tailwind CSS, Alpine.js, Vanilla JS |
| Backend      | Laravel 11 + Livewire               |
| Database     | MySQL                               |
| AR Layer     | AR.js                               |
| Local Server | XAMPP                               |

## Local Development Setup

### 1. Clone the repository

```bash
git clone https://github.com/arxjei/place-perfect-app.git
```

```bash
cd place-perfect-app
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install frontend assets

```bash
npm install && npm run dev
```

-   error? 'vite' is not recognized as an internal or external command, operable program or batch file
-   run:

```bash
npm install vite --save-dev
```

### 4. Copy .env and configure

```bash
cp .env.example .env
php artisan key:generate
```

### 5. Set up your DB

-   edit .env with DB credentials

```bash
php artisan migrate
```

### 6. Create storage symlink

````bash
php artisan storage:link

### 7. Run the server for the local computer
```bash
php artisan serve

### 8. Run the server for the mobile
```bash
php artisan serve:mobile
````

### 9. To Use ngrok server

-   [Download Here](https://download.ngrok.com/)
-   Go to [ngrok dashboard](https://dashboard.ngrok.com/) and sign in.
-   Copy your **Auth Token** from the dashboard & Add it to your machine

```bash
e.g.
ngrok config add-authtoken YOUR_TOKEN_HERE
```

-   Start a Tunnel to Your Localhost

```bash
ngrok http 8000
```

-   Custom Command to Restart App

```bash
php artisan start
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

## Notes

-   **This project is not for sale**
-   For **academic/demo** purposes only (e.g. thesis)
-   Not optimized for production deployment (yet 😉)
