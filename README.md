# 🍞 Nolan's Bakery Website 🍰

*A Sweet Digital Experience for Your Local Bakery*

This repository contains the official website for **Nolan's Bakery**, a full-featured online presence built on the robust **Laravel** framework. The site showcases the bakery's delicious menu, allows customers to browse products, add items to a shopping cart via session storage, and proceed through a final checkout process.

---

## ✨ Features

The website currently includes:

* A welcoming **Homepage** introducing Nolan's Bakery.
* An **About Us** section detailing the bakery’s history and mission.
* A **Dynamic Menu** that displays the product catalog (Cakes, Breads, Pastries) fetched from the database, logically grouped by category.
    * *Self-healing functionality:* The site includes placeholder data if the database connection fails, ensuring functionality during development or maintenance.
* A persistent **Shopping Cart** using Laravel Sessions to track product quantities.
* Simple **Add to Cart** functionality directly from the menu browsing page.
* A **Checkout Flow** page for finalizing orders, with planned payment integration.

---

## 🛠️ Technology Stack

This project is built using:

| Category | Technology | Notes |
| :--- | :--- | :--- |
| **Framework** | Laravel (PHP) | Provides structure and routing. |
| **Database** | MySQL / PostgreSQL | Managed via Eloquent ORM. |
| **Frontend** | Blade Templates | Plans for integration with **Tailwind CSS** or **Bootstrap**. |
| **Package Mgmt.**| Composer, NPM/Yarn | For managing PHP and frontend dependencies. |

---

## 🚀 Getting Started

### Prerequisites

Before you begin the installation, ensure you have the following installed on your system:

* **PHP** (v7.4 or higher)
* **Composer**
* **Web Server** (Apache/Nginx or a tool like Laravel Valet/Herd/Docker)
* **Database** (MySQL or another compatible database)

### Steps to Run the Project

1.  **Clone the repository:**
    ```bash
    git clone [https://github.com/your-username/nolans-bakery-website.git](https://github.com/your-username/nolans-bakery-website.git)
    cd nolans-bakery-website
    ```

2.  **Install PHP dependencies:**
    ```bash
    composer install
    ```

3.  **Set up environment configuration:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Configure your database:**
    Open the `.env` file and update the database credentials:
    ```ini
    DB_DATABASE=your_database_name
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

5.  **Run migrations and optionally seed data:**
    ```bash
    php artisan migrate
    # php artisan db:seed # Optional: Uncomment to populate database with initial data
    ```
    > **Note:** If your database isn't ready or seeding fails, the menu will automatically use placeholder product data from the `bakery_controller.php`.

6.  **Run the development server:**
    ```bash
    php artisan serve
    ```
    The site should now be accessible at **http://127.0.0.1:8000**.

---

## 📂 Project Structure

A high-level overview of the key files and components:

### Controller
`app/Http/Controllers/bakery_controller.php` handles all main logic, including:

* `home()` → Renders the homepage
* `menu()` → Fetches products from DB or uses placeholder data
* `cart()` → Retrieves items from session
* `addToCart()` → Adds items to cart via `POST /cart/add/{id}`
* `processOrder()` → Placeholder for checkout and payment handling

### Model
* `app/Models/Product.php` — Eloquent model for bakery products.

### Views (Blade Templates)
Located in `resources/views/`:

* `home.blade.php`
* `about.blade.php`
* `menu.blade.php`
* `cart.blade.php`
* `order.blade.php`

---

## ✍️ Contribution

Contributions are welcome and highly appreciated!

1.  **Fork** the repository.
2.  **Create a new branch:**
    ```bash
    git checkout -b feature/your-feature-name
    ```
3.  **Commit your changes:**
    ```bash
    git commit -m "Add new feature: brief description"
    ```
4.  **Push to your branch:**
    ```bash
    git push origin feature/your-feature-name
    ```
5.  Open a **Pull Request** describing your updates.

---

