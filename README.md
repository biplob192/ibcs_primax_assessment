# Assessment for Full-Stack Developer (Laravel | Vue.Js)

This repository contains a full-stack web application split into two main parts:
- **Backend**: A Laravel-based API server.
- **Frontend**: A Vue.js application that interacts with the backend API.

Follow the steps below to set up and run the project locally.

## Getting Started

### Prerequisites

Ensure you have the following installed on your local environment:
- PHP (>= 8.1)
- Composer
- Node.js and npm
- MySQL or any other compatible database

### Cloning the Repository

Begin by cloning the repository to your local machine:

```bash
git clone https://github.com/biplob192/ibcs_primax_assessment.git
```

Navigate into the project directory:

```bash
cd ibcs_primax_assessment
```

## Backend Setup
The backend is a Laravel application. Follow the steps below to configure it:

### Install Composer Dependencies
Navigate to the backend directory:

```bash
cd backend
```

Install all necessary PHP packages:

```bash
composer install --ignore-platform-reqs
```

### Environment Configuration
Copy the .env.example file to create your .env configuration file:

```bash
copy .env.example .env
```

Note: If you are using Git Bash, the above command may not work. Use Command Prompt or PowerShell instead.

### Database Configuration
Open the .env file and update the database credentials under the following section:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Generate Application Key
Run the following command to generate a unique application key:

```bash
php artisan key:generate
```

### Run Migrations and Seed Database
Set up your database by running migrations and seeding the database:

```bash
php artisan migrate:fresh --seed
```

### Install Passport
Generate the Passport keys required for API authentication:

```bash
php artisan passport:install
```

## Frontend Setup
The front end is a Vue.js application. Follow the steps below to configure it:

### Install Node.js Dependencies
Navigate to the frontend directory:

```bash
cd ../frontend
```

Install the required npm packages:

```bash
npm install
```

## Running the Application
With both the backend and front end configured, you can now run the application.

### Start the Backend Server
Navigate back to the backend directory:

```bash
cd ../backend
```

Start the Laravel development server:

```bash
php artisan serve
```

### Start the Frontend Development Server
Open a new terminal window or tab, and navigate to the frontend directory:

```bash
cd ../frontend
```

Run the following command to start the frontend server:

```bash
npm run dev
```

**Finally, browse the frontend project in a browser like Google Chrome.**

## Credentials for Login
Use the following credentials to log in:

### Super Admin User:
Email: superadmin@gmail.com
Password: password

### Admin User:
Email: admin@gmail.com
Password: password

**Note:** The admin@gmail.com user has restricted permissions and cannot create, update, or delete users. Use the superadmin@gmail.com account for full access and permissions.
