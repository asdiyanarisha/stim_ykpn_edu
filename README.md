# 🎓 STIM YKPN EDU - Academic Management System

<div align="center">
  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel" />
  <img src="https://img.shields.io/badge/Vue.js-4FC08D?style=for-the-badge&logo=vue.js&logoColor=white" alt="Vue.js" />
  <img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind" />
  <img src="https://img.shields.io/badge/JWT-000000?style=for-the-badge&logo=json-web-tokens&logoColor=white" alt="JWT" />
</div>

---

## 🌟 Overview

**STIM YKPN EDU** is a modern, high-performance academic management platform designed to streamline administrative workflows and enhance the educational experience. Built with the power of **Laravel 10** and the reactivity of **Vue 3**, this platform offers a seamless, premium interface for managing acadmic data.

## 🔥 Key Features

### 👨‍🏫 Teacher Management Module
A robust and interactive module for managing educator data:
- **Multi-step Smart Form**: A 3-step wizard with smooth transitions and auto-scroll.
- **Dynamic Field Management**: Add/remove education, research areas, and professional positions on the fly.
- **Deep Validation**: Comprehensive real-time validation on both Frontend (Vue) and Backend (Laravel).
- **Inline Error Feedback**: Precision error messaging with red-border highlighting for missing fields.

### 🔒 Security & Authentication
- **Custom JWT Implementation**: Secure, stateless authentication using HMAC-SHA256.
- **Database-Backed Validation**: Every JWT request is cross-verified against the database to ensure user account status.
- **Role-Based Access Control (RBAC)**: Optimized payload for fast performance.

### 🎨 Premium UI/UX
- **Glassmorphism Aesthetics**: Modern, clean, and elegant design using Tailwind CSS.
- **Micro-animations**: Subtle transitions for a high-end feel.
- **Responsive Design**: Fully optimized for mobile and desktop views.

## 🛠️ Tech Stack

- **Backend**: [Laravel 10](https://laravel.com/) (PHP 8.1+)
- **Frontend**: [Vue.js 3](https://vuejs.org/) (Composition API)
- **Styling**: [Tailwind CSS](https://tailwindcss.com/)
- **Auth**: Custom JWT (JSON Web Tokens)
- **Database**: MySQL / PostgreSQL
- **State Management**: Reactive State (Vue)

## 🚀 Getting Started

### 📦 First Time Setup
1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/stim_ykpn_edu.git
   cd stim_ykpn_edu
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Initialization**
   ```bash
   # Configure your DB in .env first
   php artisan migrate --seed
   ```

---

### 💻 Local Development Mode
To run the project in a development environment with Hot Module Replacement (HMR):

1. **Start Backend Server**
   ```bash
   php artisan serve
   ```
2. **Start Frontend Compiling (Vite)**
   ```bash
   npm run dev
   ```
   *Access the app at `http://123.0.0.1:8000`*

---

### 🌐 Hosting / Production Deployment
Follow these steps to deploy the application to a live server (VPS or Shared Hosting):

1. **Optimize Dependencies**
   ```bash
   composer install --optimize-autoloader --no-dev
   npm install && npm run build
   ```

2. **Configure Environment**
   - Upload all files to your server.
   - Ensure `.env` is configured with production database credentials.
   - Set `APP_ENV=production` and `APP_DEBUG=false`.

3. **Database & Optimization**
   ```bash
   php artisan migrate --force
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

4. **Storage & Permissions**
   - Create symbolic link: `php artisan storage:link`
   - Set directory permissions (Linux):
     ```bash
     chmod -R 775 storage bootstrap/cache
     chown -R www-data:www-data .
     ```

5. **Web Server Configuration**
   - Point your Domain/Virtual Host root to the `/public` directory of the project.
   - For **Nginx**, ensure `location /` handles requests via `index.php`.
   - For **Shared Hosting**, you may need to move `/public` contents to `public_html` or use an `.htaccess` redirect.

## 📂 Project Structure

```bash
├── app/
│   ├── Http/Controllers/Api/  # Unified API Layer
│   ├── Http/Middleware/      # JWT Security Gate
│   └── Helpers/              # JwtHelper Logic
├── database/
│   ├── migrations/           # DB Schema (Users, Roles, Teachers)
│   └── seeders/              # Initial Setup (Admins, Roles)
├── resources/js/
│   ├── Pages/Teacher/        # Teacher Management Logic
│   ├── Components/           # Atomic & Organism Components
│   └── Helpers/              # Frontend Utilities
└── routes/
    ├── web.php               # Page Routing
    └── api.php               # Protected Data Streams
```

---

<div align="center">
  Developed with ❤️ for <b>STIM YKPN</b>
</div>
