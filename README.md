# Task 1: Book API (CakePHP 5.x)

This project is a RESTful API for managing books, built using CakePHP 5.x.  
It supports full CRUD operations with MySQL, returns JSON responses, and follows OOP design.

---

## 📚 Features

- RESTful API with CakePHP 5.x
- JSON responses in unified format: `{ success: true/false, data: ... }`
- Supports create, read, update, delete books
- Uses classes (OOP) to encapsulate logic and data, such as `BooksController`, `BooksTable`, and `Book Entity`
- Data is stored in a MySQL database 
- Tested with Postman and curl

---

## 📦 Technologies Used

- Language: PHP
- Framework: [CakePHP 5.x](https://cakephp.org)
- Database: MySQL (via phpMyAdmin)
- Dev Tools: Composer, Postman

---

## ⚙️ Installation & Setup

1. Make sure you have [Composer](https://getcomposer.org/) installed.
2. Clone or extract this project to your web root.
3. Run:
   ```bash
   composer install
   bin/cake server -p 8765
4. Access the API at: http://localhost:8765/books

🗃️ Database Setup
Import this table using phpMyAdmin or run the SQL below:

CREATE TABLE books (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  author VARCHAR(255) NOT NULL,
  year YEAR NOT NULL,
  available BOOLEAN NOT NULL
);

Then configure config/app_local.php for your database settings:

'Datasources' => [
    'default' => [
        'host' => 'localhost',
        'username' => 'your_username',
        'password' => 'your_password',
        'database' => 'your_database_name',
        'driver' => 'Cake\Database\Driver\Mysql',
        ...
    ]
]

📚 API Endpoints
Method        	Endpoint	                Description
GET	            /books	                    Get all books
GET	            /books/view/:id             Get a single book
POST	        /books/add                	Add a new book
PUT	            /books/edit/:id	            Update a book
DELETE	        /books/delete/:id	        Delete a book

📥 Postman Collection
A Postman Collection is included for quick testing:
👉 Books_API_Collection.postman_collection.json

🙋 Author
Developed by: Boxuan Chen (陈博轩)
