# Chat app using rachet
Testing rachet websocket for php

## Tech used:

<img src="https://skillicons.dev/icons?i=html,css,javascript,php" />

## Getting Started

### Prerequisites

- PHP 7.4 or higher
- Composer
- MySQL/MariaDB

### 1. Database Setup

Create a MySQL database named `chat_app_ratchet` and a `messages` table:

```sql
CREATE DATABASE chat_app_ratchet;

USE chat_app_ratchet;

CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    text TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

You can configure your database credentials in `dist/connect/config.php`.

### 2. Install Dependencies

Navigate to the `dist` directory and install the required PHP packages using Composer:

```bash
cd dist
composer install
```

### 3. Run the WebSocket Server

Start the Ratchet WebSocket server from the `dist` directory:

```bash
cd dist
php connect/server.php
```

The server will start listening on port `8080`.

### 4. Run the Web Application

You can serve the `dist` directory using PHP's built-in web server:

```bash
php -S localhost:8000 -t dist
```

Now, open your browser and navigate to `http://localhost:8000`.
