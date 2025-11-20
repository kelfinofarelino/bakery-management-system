# Toko Kue - Bakery Management System

A complete web application for managing cake catalog in a bakery store.

## Features

- ✅ User registration and login
- ✅ Session management
- ✅ Cake catalog with Bootstrap cards
- ✅ Add, edit, and delete cakes
- ✅ Image upload functionality
- ✅ Responsive design

## Technologies Used

- PHP
- MySQL
- Bootstrap 5
- HTML/CSS
- JavaScript

## Installation

1. Import `toko_roti.sql` to your MySQL database
2. Configure database connection in `config.php`
3. Create `uploads` directory with write permissions
4. Access via web server

## Database Structure

- **users**: id, username, password, created_at
- **kue**: id, nama, harga, stok, foto, created_at

## Pages

- `register.php` - User registration
- `login.php` - User login
- `dashboard.php` - Cake catalog
- `tambah_kue.php` - Add new cake
- `edit_kue.php` - Edit existing cake
- `hapus_kue.php` - Delete cake

## Security Features

- Password hashing with `password_hash()`
- Session-based authentication
- SQL injection prevention
- File upload validation
