# AI Prompt Manager

A modern web application built with Laravel to organize, manage, and quickly access your AI prompts. Perfect for ChatGPT users, content creators, and developers.

**Live Demo:** [https://ai-prompt-manager-ssxy.onrender.com](https://ai-prompt-manager-ssxy.onrender.com)

## Features

- **Prompt Management** — Create, view, and organize AI prompts with titles, categories, and descriptions
- **Categories** — Group prompts by topic (Coding, Writing, Marketing, Images, etc.)
- **Search** — Find any prompt instantly by title or content
- **One-Click Copy** — Copy any prompt to your clipboard with a single click
- **Favorites** — Save your most-used prompts for quick access
- **User Authentication** — Secure registration, login, and password reset
- **Green Theme** — Modern green gradient UI across all pages
- **Responsive Design** — Works on desktop, tablet, and mobile
- **Landing Page** — Beautiful homepage with features, testimonials, and FAQ

## Tech Stack

| Technology | Purpose |
|---|---|
| Laravel 8 | Backend Framework |
| PHP 8.x | Server-side Language |
| MySQL / SQLite | Database |
| Bootstrap 5 | UI Components |
| Alpine.js | Interactive Elements |
| Inter Font | Typography |
| Laravel Breeze | Authentication Scaffolding |

## Installation

### Prerequisites

- PHP 8.1 or higher
- Composer
- Node.js & NPM
- MySQL
- XAMPP / Laravel Herd / Docker

### Steps

1. **Clone the repository**
```bash
git clone https://github.com/GeethmiUduwana/ai_prompt_manager.git
cd ai_prompt_manager
```

2. **Install PHP dependencies**
```bash
composer install
```

3. **Install JavaScript dependencies**
```bash
npm install
```

4. **Copy environment file**
```bash
cp .env.example .env
```

5. **Generate application key**
```bash
php artisan key:generate
```

6. **Configure database** in `.env` file
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ai_prompt_manager
DB_USERNAME=root
DB_PASSWORD=
```

7. **Run migrations**
```bash
php artisan migrate
```

8. **Seed categories**
```bash
php artisan db:seed
```

9. **Build assets**
```bash
npm run dev
```

10. **Start the server**
```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser.

## Database Structure

### Tables

| Table | Description |
|---|---|
| `users` | User accounts (name, email, password) |
| `categories` | Prompt categories (name) |
| `prompts` | AI prompts (title, prompt text, description, category_id, user_id) |
| `favorites` | User favorites (user_id, prompt_id) |

### Relationships

- A **User** has many **Prompts**
- A **User** has many **Favorites**
- A **Category** has many **Prompts**
- A **Prompt** belongs to a **User** and a **Category**
- A **Favorite** links a **User** to a **Prompt**

## Pages

| Page | URL | Description |
|---|---|---|
| Landing Page | `/` | Homepage with features, screenshots, testimonials, FAQ |
| Dashboard | `/dashboard` | Stats, recent prompts, quick actions, category breakdown |
| Prompts List | `/prompts` | All user prompts with search |
| Create Prompt | `/prompts/create` | Form to add a new prompt |
| Categories | `/categories` | Manage prompt categories |
| Favorites | `/favorites` | View saved favorite prompts |
| Login | `/login` | User login |
| Register | `/register` | User registration |

## Default Categories

The seeder creates 8 default categories:

1. ChatGPT Prompts
2. Image Generation
3. Code Assistant
4. Content Writing
5. Marketing
6. Education
7. Business
8. Creative Writing

## Project Structure

```
ai_prompt_manager/
├── app/
│   ├── Http/Controllers/
│   │   ├── CategoryController.php
│   │   ├── FavoriteController.php
│   │   └── PromptController.php
│   └── Models/
│       ├── Category.php
│       ├── Favorite.php
│       ├── Prompt.php
│       └── User.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── views/
│   │   ├── auth/           (login, register, etc.)
│   │   ├── categories/
│   │   ├── components/
│   │   ├── dashboard.blade.php
│   │   ├── favorites/
│   │   ├── layouts/
│   │   ├── prompts/
│   │   └── welcome.blade.php
│   └── css/
├── routes/
│   └── web.php
└── public/
```

## Screenshots

### Landing Page
- Hero section with green gradient
- Feature cards
- Screenshots demo
- User testimonials
- FAQ accordion

### Dashboard
- Stats cards (Prompts, Categories, Favorites)
- Recent prompts list
- Quick action buttons
- Category progress bars

### Prompts Page
- Search bar
- Prompt cards with copy and favorite buttons
- Category badges

## Available Commands

```bash
php artisan serve          # Start development server
php artisan migrate        # Run database migrations
php artisan db:seed        # Seed default categories
php artisan view:clear     # Clear compiled views
npm run dev                # Compile assets (development)
npm run prod               # Compile assets (production)
```

## License

This project is open-source and available for personal use.
