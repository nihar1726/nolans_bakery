# 🍞 Nolan's Bakery Website 🍰  
*A Sweet Digital Experience for Your Local Bakery*

This repository contains the official website for **Nolan's Bakery**, a full-featured online presence built on the **Laravel** framework.  
The site showcases the bakery's menu, allows customers to browse products, add items to a shopping cart via session storage, and proceed to a final checkout process.

---

## ✨ Features

- **Homepage**: A welcoming introduction to Nolan's Bakery.  
- **About Us**: Information about the bakery's history and mission.  
- **Dynamic Menu**: Displays the full product catalog (Cakes, Breads, Pastries) fetched from the database, grouped by category.  
  - Includes robust placeholder data if the database connection fails, ensuring the site remains functional during development.  
- **Shopping Cart**: Persistent cart logic using Laravel Sessions to track quantities of products.  
- **Add to Cart**: Simple functionality to add items directly from the menu.  
- **Order/Checkout Flow**: Dedicated page for finalizing the order, including *TO-DOs* for payment integration and order persistence.  

---

## 🛠️ Technology Stack

The Nolan's Bakery website is built using the following technologies:

| Category | Technology |
|-----------|-------------|
| **Framework** | Laravel (PHP) |
| **Database** | MySQL / PostgreSQL (via Eloquent ORM) |
| **Frontend** | Blade Templates (planned integration of Tailwind CSS or Bootstrap) |
| **Package Management** | Composer (PHP), NPM/Yarn (Frontend assets) |

---

## 🚀 Getting Started

### Prerequisites

You will need the following software installed on your system:

- PHP *(v7.4 or higher recommended)*  
- Composer  
- Web server *(Apache/Nginx)* or Laravel Valet/Herd/Docker  
- MySQL or another compatible database  

---

### Installation Steps

#### 1. Clone the Repository
```bash
git clone https://github.com/your-username/nolans-bakery-website.git
cd nolans-bakery-website
