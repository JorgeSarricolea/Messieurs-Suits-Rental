# Messieurs

Plataforma para la renta y gestión de trajes para caballeros.

## Table of Contents

- [Messieurs](#messieurs)
  - [Table of Contents](#table-of-contents)
  - [Introduction](#introduction)
  - [Getting Started](#getting-started)
    - [Prerequisites](#prerequisites)
    - [Installation](#installation)
  - [Features](#features)
  - [Contribution](#contribution)
  - [Copyright](#copyright)

## Introduction

Messieurs your online destination to access fashion without compromises. This web system has been designed with comfort and elegance in mind, providing users with the ability to wear spectacular outfits without the burden of ownership. Additionally, for administrators, Messieurs offers a comprehensive management platform to ensure a smooth and efficient experience.

## Getting Started

To get started with "Messieurs-Suits-Rental", follow these simple steps:

### Prerequisites

> [!IMPORTANT] > **XAMPP and MySQL:** Ensure that you have XAMPP and MySQL installed on your system.

> **Database:** Consider creating the database with the tables correctly, you cand find it in the db_template file.

### Installation

1. Clone the repository to your local machine:

```
git clone https://github.com/JorgeSarricolea/Messieurs-Suits-Rental
```

2. Navigate to the project directory:

```
cd Messieurs-Suits-Rental
```

3. Install the environment variables dependencie for PHP:

```
composer require vlucas/phpdotenv
```

> [!TIP]
> Read more about how to use the environment variables in PHP by [clicking here](https://github.com/vlucas/phpdotenv).

4. Validate your environment variables in your file .env:

```
DB_SERVERNAME=your-host
DB_USERNAME=your-username
DB_PASSWORD=your-password
DB_NAME=your-db-name
```

5. Run XAMPP:

```
cd /opt/lampp
sudo ./xampp start
```

6. Open your browser with the correctly path, it could be like:

```
http://localhost/Messieurs/pages/index.php
```

## Features

Some of the key features of this project include:

- **Landing page:** The system has a main page.

- **Login/Signup:** The system has a user registration and log in.

- **Catalog:** The system has a catalog that works with filters by product type.

- **Quotes:** The system has a section to send quotes.

- **Admin page:** The system has a page for product administration.

- **CRUD:** The system has a complete CRUD for all products and users.

## Contribution

While contributions to this project are welcome. If you would like to contribute, feel free to fork this repository and submit a pull request.

## Copyright

This project was created by [Jorge Sarricolea](https://jorgesarricolea.com). if you have any specific code questions or would like to chat about programming, feel free to contact me on [WhatsApp](https://wa.me/529381095593).
