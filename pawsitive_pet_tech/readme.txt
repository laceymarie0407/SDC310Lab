# 🐾 Pawsitive Pet Tech

A PHP-based web application that simulates an online pet tech store.  
Users can browse products, add them to a shopping cart, adjust quantities, and check out.

---

## 📂 Project Structure

| Folder | Purpose |
|--------|----------|
| **/config** | Contains configuration files such as the database connection (`db_connect.php`). |
| **/controllers** | Handles application logic — receives input from users, interacts with models, and updates views. |
| **/models** | Manages data interactions, including database queries and CRUD (Create, Read, Update, Delete) operations. |
| **/views** | Contains the user interface templates (catalog page, shopping cart, checkout page). |
| **/public** | The front-facing directory. Contains files accessible by the browser (e.g., `index.php`, CSS, and JS). |

---

## 🧱 Database Structure

**Database Name:** `pawsitive_pet_tech`

**Table: `products`**

| Column | Type | Description |
|--------|------|-------------|
| `product_id` | INT (Primary Key, Auto Increment) | Unique identifier for each product |
| `product_code` | VARCHAR | Product code or SKU |
| `product_name` | VARCHAR | Product name |
| `product_description` | TEXT | Description of the product |
| `price` | DECIMAL(10,2) | Product price |

---

## 🛒 Core Features

- Display a catalog of at least **five products**
- Add, remove, or adjust product quantities in the cart
- Prevent quantities below zero
- View a cart summary with:
  - Product details
  - Subtotal
  - Tax (5%)
  - Shipping (10% of pre-tax total)
  - Grand total
- Checkout functionality that clears the cart and returns to the catalog

---

## 🧰 Setup Instructions

1. Place this project in your XAMPP `htdocs` directory:  
   `C:\xampp\htdocs\pawsitive_pet_tech`

2. Start **Apache** and **MySQL** in XAMPP.

3. Create the database:
   - Visit [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
   - Create a new database named `pawsitive_pet_tech`
   - Import your SQL file if you’ve exported one.

4. Open your browser and navigate to:  
   👉 [http://localhost/pawsitive_pet_tech/public/](http://localhost/pawsitive_pet_tech/public/)

---

## 🗓 Project Phase Tags (for GitHub)

| Phase | Description |
|--------|-------------|
| **Phase #1** | Initial project plan (Week 1) |
| **Phase #2** | Database & framework setup (Week 2) |
| **Phase #3** | Database connectivity and CRUD operations (Week 3) |
| **Phase #4** | MVC structure applied (Week 4) |
| **Phase #5** | Final testing and deployment (Week 5) |

---

## ✏️ Notes
This project is developed for a PHP Web Application course and follows a five-week structured plan.  
It demonstrates the ability to:
- Plan and execute a web project  
- Connect PHP with MySQL  
- Use MVC architecture  
- Manage code with GitHub

---
