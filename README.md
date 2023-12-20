# PSU Library Management System

## Description

This is a library management system that allows users to check out books, return books, and add books to the library. The system is written in Laravel and uses a MySQL database to store information about the books and users.

#### TODO

##### Books

-   [ ] View list of books
-   [ ] Add book to library
-   [ ] Update book in library
-   [ ] View book Details
-   [ ] Remove book from library

##### Borrowed Books

-   [ ] View list of borrowed books
-   [ ] Borrow book
-   [ ] Return book
-   [ ] View borrowed book details

##### Adming Dashboard

-   [ ] Display number of books in library
-   [ ] Display number of borrowed books
-   [ ] Display number of users
-   [ ] Display number of users who have borrowed books
-   [ ] View list of recently borrowed books
-   [ ] View list of recently return books
-   [ ] View list of recent book list updates (additions, removals, updates)

## Installation

### Requirements

```text
-   PHP 8.1^
-   Composer
-   MySQL 8.0^
```

### Steps

1. Clone the repository

```bash
git clone
```

2. Install dependencies

```bash
composer install

npm install
```

3. Create a `.env` file

```bash
cp .env.example .env
```

**Note:** You may need to update the `DB_*` variables in the `.env` file to match your MySQL database credentials.

4. Run the migrations and db seeder

```bash
php artisan migrate --seed
```

5. Run npm run dev

```bash
npm run dev
```

6. Start the server

```bash
php artisan serve
```
