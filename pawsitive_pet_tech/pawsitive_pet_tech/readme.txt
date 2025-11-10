🐾 Pawsitive Pet Tech

A PHP-based web application simulating an online pet tech store.
Users can browse products, add them to a shopping cart, adjust quantities, and check out.

📂 Project Structure
Folder	Purpose
/config	Configuration files, including database connection (db_connect.php).
/controllers	Handles application logic — receives user input, interacts with models, and updates views. Example: ProductController.php manages catalog, cart, and checkout logic.
/models	Handles database interactions and CRUD operations (Product.php, Cart.php).
/views	User interface templates (catalog, cart, checkout). Cart forms now point to proper controller actions (update, checkout).
/public	Front-facing directory containing index.php, CSS, JS, and assets.
🧱 Database Structure

Database Name: pawsitive_pet_tech

Table: products

Column	Type	Description
product_id	INT (Primary Key, Auto Increment)	Unique identifier for each product
product_code	VARCHAR	Product code or SKU
product_name	VARCHAR	Product name
product_description	TEXT	Product description
price	DECIMAL(10,2)	Product price

Table: cart_items (if implemented for session-based cart storage)

Column	Type	Description
cart_id	INT (Primary Key, Auto Increment)	Unique cart item ID
product_id	INT	Reference to products.product_id
quantity	INT	Number of units in cart
🛒 Core Features

Display a catalog of five or more products
Add, remove, or adjust product quantities in the cart
Prevent negative quantities

Cart summary shows:
   Product details
   Subtotal
   Tax (5%)
   Shipping (10% of pre-tax total)
   Grand total
Checkout clears the cart and returns to catalog
Form actions now point correctly to controller methods:
   Update quantities → action=update
   Checkout → action=checkout
MVC structure ensures separation of concerns

🧰 Setup Instructions
Place the project in XAMPP htdocs: C:\xampp\htdocs\pawsitive_pet_tech
Start Apache and MySQL in XAMPP.
Create the database:
   Visit http://localhost/phpmyadmin
   Create pawsitive_pet_tech
   Import SQL if available
Navigate to: 👉 http://localhost/pawsitive_pet_tech/public/

🗓 Project Phase Tags (for GitHub)
Phase	Description
Phase #1	Initial project plan (Week 1)
Phase #2	Database & framework setup (Week 2)
Phase #3	Database connectivity and CRUD operations (Week 3)
Phase #4	MVC structure applied, controllers and cart updates (Week 4)
Phase #5	Final testing, form action fixes, deployment (Week 5)

✅ Recent Updates / Notes
Cart & Checkout Logic:
   cart.php removed database queries; now relies on $products from CartController.
   Form actions point to correct controller methods for update/checkout.
Controller Improvements:
   ProductController handles all catalog, cart, and checkout logic.
   Removed any inline database queries from views.
Testing Notes:
   Quantities cannot go below zero.
   Grand total, tax, and shipping calculations verified.
   Cart updates and checkout workflow tested for proper session handling.