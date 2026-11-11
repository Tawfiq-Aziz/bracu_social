# Bracu Social

Bracu Social is a Laravel-based social platform. It includes user authentication, a post feed with interactions, polls, events, user profiles, and messaging.


### 1. Landing Page
The public home/landing page introducing the platform.

![Landing page](docs/screenshots/Screenshot%202026-11-11%20210148.png)

### 2. Signup / Login Page
Authentication page for creating an account or signing in (including Google login support in the app).

![Signup and login page](docs/screenshots/Screenshot%202026-11-11%20210228.png)

### 3. Dashboard / Feed
Main authenticated feed/dashboard showing posts and community content (posts, interactions, and related feed elements).

![Dashboard and feed](docs/screenshots/Screenshot%202026-11-11%20210317.png)

### 4. Messaging / Chat
Chat/messaging interface for user-to-user conversations.

![Messaging and chat](docs/screenshots/Screenshot%202026-11-11%20210336.png)

## Features

- User registration and login (including Google OAuth routes)
- Dashboard feed with posts
- Post interactions (like/dislike/comment)
- Poll creation and voting
- Event board
- User profiles and user search
- Direct messaging/chat between users

## Tech Stack

- Laravel (PHP)
- Blade templates
- Vite / frontend assets
- Database-backed posts, interactions, polls, events, and chat

## Local Setup

1. Install PHP dependencies:
   ```bash
   composer install
   ```
2. Install frontend dependencies:
   ```bash
   npm install
   ```
3. Create environment config:
   ```bash
   copy .env.example .env
   ```
4. Generate app key:
   ```bash
   php artisan key:generate
   ```
5. Configure database settings in `.env`, then run migrations:
   ```bash
   php artisan migrate
   ```
6. Start the app:
   ```bash
   php artisan serve
   npm run dev
   ```

