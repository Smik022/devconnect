# DevConnect

DevConnect is a Laravel-based platform that connects developers with employers. It features GitHub integration, role-based dashboards, and simple user management to streamline the hiring and collaboration process.

---

## 🚀 Features

- Developer & Employer registration and login
- Role-based dashboard (developer/employer)
- GitHub username integration and profile display
- Edit profile, logout, and secure session handling
- Responsive design using Laravel Blade and Bootstrap

---

## ⚙️ Requirements

- PHP >= 8.1
- Composer
- Laravel 10+
- Node.js & NPM (for frontend asset compilation)
- MySQL / MariaDB

---

## 🛠️ Installation & Setup

Follow the steps below to get the project up and running locally:

### 1. Clone the repository
```bash
git clone https://github.com/your-username/devconnect.git
cd devconnect
2. Install PHP dependencies via Composer
bash
Copy
Edit
composer install
3. Install frontend dependencies & compile assets
bash
Copy
Edit
npm install
npm run dev
4. Set up environment configuration
bash
Copy
Edit
cp .env.example .env
php artisan key:generate
Update the .env file with your database credentials:

ini
Copy
Edit
DB_DATABASE=your_database_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
5. Run migrations
bash
Copy
Edit
php artisan migrate
6. Launch the development server
bash
Copy
Edit
php artisan serve
Visit http://localhost:8000 in your browser.

🧪 Optional: Seed default users
If you've included seeders for developer/employer roles:

bash
Copy
Edit
php artisan db:seed
📦 Production Build
To compile assets for production:

bash
Copy
Edit
npm run build
📁 Folder Structure Highlights
/app/Models – User, Profile, etc.

/resources/views – Blade templates for layouts, login, dashboards

/routes/web.php – Web routes

/public – Compiled assets and public index

🙌 Contributing
Feel free to fork this repository, create a branch, and submit pull requests. Feedback and feature ideas are always welcome.

📄 License
This project is licensed under the MIT License.

sql
Copy
Edit

### ✅ Next Step
After creating `README.md`, commit it:

```bash
git add README.md
git commit -m "Add professional README"