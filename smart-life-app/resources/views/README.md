# SmartLife Manager (Gym & Logistics)
A specialized application built with the Laravel-Vue-Inertia stack. This project combines a high-performance Gym Progress Tracker with a Household Logistics System to manage inventory and daily tasks.

Designed as a showcase for modern enterprise development standards in the Aachen tech region.

## Prerequisites
Ensure you have the following installed on your local machine:

PHP 8.2+

Composer

Node.js (v18+) & NPM

SQLite (or MySQL/PostgreSQL)

## Getting Started
Follow these steps to get your local development environment running:

1. Clone the Repository

git clone <your-repo-url>
cd smart-life-app
2. Install Backend Dependencies

composer install
3. Install Frontend Dependencies

npm install
4. Environment Configuration
Copy the example environment file and generate an application key:


cp .env.example .env
php artisan key:generate
Note: If you are using SQLite (recommended for quick setup), create an empty database file:
touch database/database.sqlite
Then, update your .env file to: DB_CONNECTION=sqlite

5. Database Migrations
Create the table structure and seed the database:


php artisan migrate
6. Compile Assets
Run the Vite development server:


npm run dev
7. Start the Application
In a second terminal window, start the Laravel server:

php artisan serve

Visit the app at: http://127.0.0.1:8000

## Project Architecture
Backend: Laravel 11 (Models, Controllers, Migrations)

Frontend: Vue.js 3 with Inertia.js (Single Page Application experience)

Styling: Tailwind CSS

Authentication: Laravel Breeze (Session-based)
    ^^^^
## Key Directories
app/Models: Database logic and relationships.

resources/js/Pages: Vue components for the UI.

routes/web.php: Application routing.