# Twitter Clone

## Features

- Authentication
- Post with or without images
- Follower system
- Basic messaging system
- Interaction with posts

## Installation

### Versions used

- PHP 8.2.12
- Composer
- MySQL or another database

### Steps

1. Clone the repository
    ```bash
    git clone https://github.com/REZSOfficial/twitter-clone.git
    ```
2. Navigate to the project directory
    ```bash
    cd twitter-clone
    ```
3. Install dependencies
    ```bash
    composer install
    npm install
    ```
4. Copy `.env.example` to `.env` and configure your environment variables (db connection)
    ```bash
    cp .env.example .env
    ```
5. Generate an application key
    ```bash
    php artisan key:generate
    ```
6. Run migrations
    ```bash
    php artisan migrate
    ```
7. (Optional, creates some users and posts, uses the placeholder images in pubilc folder) Seed the database
    ```bash
    php artisan migrate --seed
    ```

## Usage

### Running the Application

Start the local development server
```bash
php artisan serve
npm run dev
