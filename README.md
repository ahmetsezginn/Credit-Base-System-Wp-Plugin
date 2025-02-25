# Credit-Base-System-Wp-Plugin

WooCommerce Credit System
Credit-based digital product download system on WooCommerce. Users can download files with purchased credits.

License
WooCommerce Version

📌 Features
Loan Management Panel:
Admin Panel
Manage users' credit balances.

Credit Product:
Credit Product
Create products that add credits (e.g. 100 Credit Pack).

File Download Control:
Users without credits cannot download files.
Download Error

My Account Integration:
My Account Credits
Users can view their credit balance.

🛠️ Installation
1. Upload to WordPress
Download Latest Version

WordPress Admin > Plugins > Add New > Install

Select the custom-download-credits.zip file and activate it.

2. Manual Installation
bash
Copy
cd wp-content/plugins
git clone https://github.com/sizin-kullanici-adi/woocommerce-credit-system.git
🚀 Usage
A. Admin Panel
Loan Product Creation

Check “Credit Product” when adding a product.

Enter the credit amount (e.g. 100).

User Credit Management

Edit user credits from the Credit Management menu.

B. User Side
Loan Purchase

Add credit pack products to cart and purchase.

File Download

Use the “Download” button on the product page with credits.

💻 For Developers
Structure
Copy
📦woocommerce-credit-system
 ┣ 📂admin # Admin panel classes
 ┣ 📂public # Frontend classes
 ┣ 📂includes #Core logic
 ┣ 📂assets # CSS/JS/Images
 ┣ 📜README.md
 ┗ 📜LICENSE
Addictions
PHP 7.4+

WordPress 5.6+

WooCommerce 5.0+

Hooks & Filters
php
Copy
// Credit calculation filter
add_filter('cdc_credit_calculation', function($credit, $product_id) {
    return $credit * 2; // Make credit 2x
});
🤝 Contribution
Fork the repo.

Create new branch: git checkout -b feature/new-feature

Commit the changes.

Open Pull Request.

📜 License
GNU General Public License v3.0 - Details

❗ Support
Open GitHub Issues for bugs or suggestions.

Thank you!
Thank you for using the plugin. You can support by giving stars and sharing! ⭐
