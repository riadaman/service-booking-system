# Service Booking System

A comprehensive Laravel-based REST API for managing service bookings with role-based access control, user authentication, and administrative features.

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [System Requirements](#system-requirements)
- [Installation](#installation)
- [Database Setup](#database-setup)
- [Configuration](#configuration)
- [API Documentation](#api-documentation)
- [Authentication](#authentication)
- [User Roles](#user-roles)
- [Project Structure](#project-structure)
- [Testing](#testing)
- [Seeding Data](#seeding-data)
- [Error Handling](#error-handling)
- [Contributing](#contributing)
- [License](#license)

## Overview

The Service Booking System is a robust REST API built with Laravel that allows users to book various services while providing administrators with comprehensive management capabilities. The system implements secure authentication, role-based permissions, and follows Laravel best practices.

## Features

### Core Features
- **User Authentication**: Secure registration, login, and logout using Laravel Sanctum
- **Role-Based Access Control**: Separate permissions for admin and regular users
- **Service Management**: Complete CRUD operations for services (admin only)
- **Booking System**: Users can create bookings and view their booking history
- **Admin Dashboard**: Administrators can view all bookings and manage services
- **Data Validation**: Comprehensive request validation for all endpoints
- **Response Helpers**: Standardized API responses across all endpoints
- **Unit Testing**: Test coverage for critical functionality

### Security Features
- Token-based authentication with Laravel Sanctum
- Request validation and sanitization
- Role-based route protection
- Secure password hashing

## Tech Stack

- **Framework**: Laravel 10.x
- **PHP Version**: 8.1+
- **Database**: MySQL 8.0+
- **Authentication**: Laravel Sanctum
- **Testing**: PHPUnit
- **Architecture**: MVC with Helper Classes

## System Requirements

- PHP >= 8.1
- Composer
- MySQL >= 8.0
- Node.js (for asset compilation, if needed)
- Git

## Installation

### 1. Clone the Repository
```bash
git clone git@github.com:riadaman/service-booking-system.git
cd service-booking-system
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure Environment Variables
Edit the `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=service_booking_system
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Database Setup
```bash
php artisan migrate
php artisan db:seed
```

### 6. Start the Development Server
```bash
php artisan serve
```

The API will be available at `http://localhost:8000`

## Database Setup

### Migrations
The system includes the following database tables:
- `users` - User accounts with role information
- `services` - Available services with pricing
- `bookings` - Service bookings with status tracking

### Seeders
- **AdminSeeder**: Creates a default admin user
- **ServiceSeeder**: Populates 15 sample services

## Configuration

### Laravel Sanctum
The API uses Laravel Sanctum for authentication. Ensure the following middleware is configured in `app/Http/Kernel.php`:

```php
'api' => [
    \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
    'throttle:api',
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
],
```

## API Documentation

### Base URL
```
http://localhost:8000/api
```

### Authentication Endpoints

#### Register User
```http
POST /api/register
Content-Type: application/json

{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123"
}
```

#### Login User
```http
POST /api/login
Content-Type: application/json

{
    "email": "john@example.com",
    "password": "password123"
}
```

#### Logout User
```http
GET /api/logout
Authorization: Bearer {token}
```

### Service Endpoints (Admin Only)

#### Create Service
```http
POST /api/services
Authorization: Bearer {admin_token}
Content-Type: application/json

{
    "name": "House Cleaning",
    "description": "Professional house cleaning service",
    "price": 50.00,
    "status": true
}
```

#### Update Service
```http
POST /api/services/{id}
Authorization: Bearer {admin_token}
Content-Type: application/json

{
    "name": "Updated Service Name",
    "description": "Updated description",
    "price": 75.00,
    "status": true
}
```

#### Delete Service
```http
DELETE /api/services/{id}
Authorization: Bearer {admin_token}
```

#### List All Services
```http
GET /api/services
Authorization: Bearer {token}
```

### Booking Endpoints

#### Create Booking
```http
POST /api/bookings
Authorization: Bearer {token}
Content-Type: application/json

{
    "service_id": 1,
    "date": "2025-08-01"
}
```

#### Get User Bookings
```http
GET /api/bookings
Authorization: Bearer {token}
```

#### Get All Bookings (Admin Only)
```http
GET /api/admin/bookings
Authorization: Bearer {admin_token}
```

## Authentication

The system uses Laravel Sanctum for API authentication. After successful login, users receive a bearer token that must be included in subsequent requests.

### Token Usage
Include the token in the Authorization header:
```
Authorization: Bearer {your_token_here}
```

## User Roles

### Regular User
- Register and login
- View available services
- Create bookings
- View their own bookings

### Admin User
- All regular user permissions
- Create, update, and delete services
- View all bookings from all users
- Manage system data

### Default Admin Credentials
```
Email: admin@example.com
Password: password123
```

## Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   └── API/
│   │       ├── AuthController.php
│   │       ├── ServiceController.php
│   │       └── BookingController.php
│   └── Requests/
│       ├── RegisterRequest.php
│       ├── ServiceRequest.php
│       └── BookingRequest.php
├── Models/
│   ├── User.php
│   ├── Service.php
│   └── Booking.php
└── Helpers/
    ├── ResponseHelper.php
    ├── ServiceHelper.php
    └── BookingHelper.php

database/
├── migrations/
├── seeders/
│   ├── AdminSeeder.php
│   ├── ServiceSeeder.php
│   └── DatabaseSeeder.php
└── factories/
    └── ServiceFactory.php

tests/
└── Unit/
    └── BookingHelperTest.php
```

## Testing

### Running Tests
```bash
# Run all tests
php artisan test

# Run specific test class
php artisan test --filter BookingHelperTest

# Run tests with coverage
php artisan test --coverage
```

### Test Structure
- **Unit Tests**: Test individual helper classes and methods
- **Feature Tests**: Test complete API endpoints (can be added)

## Seeding Data

### Seed All Data
```bash
php artisan db:seed
```

### Seed Specific Seeders
```bash
# Seed admin user only
php artisan db:seed --class=AdminSeeder

# Seed services only
php artisan db:seed --class=ServiceSeeder
```

### Sample Data
- **Admin User**: 1 admin account with full permissions
- **Services**: 15 sample services with various categories and pricing

## Error Handling

The API implements comprehensive error handling with standardized responses:

### Success Response Format
```json
{
    "data": {...},
    "message": "Operation successful",
    "status": "success",
    "code": 200
}
```

### Error Response Format
```json
{
    "message": "Error description",
    "status": "error",
    "code": 400
}
```

### Common HTTP Status Codes
- `200` - Success
- `201` - Created
- `400` - Bad Request
- `401` - Unauthorized
- `403` - Forbidden
- `404` - Not Found
- `422` - Validation Error
- `500` - Internal Server Error

## Validation Rules

### User Registration
- `name`: Required, string, max 255 characters
- `email`: Required, valid email, unique, max 255 characters
- `password`: Required, minimum 8 characters, max 30 characters

### Service Creation/Update
- `name`: Required, string, max 255 characters
- `description`: Required, string
- `price`: Required, numeric
- `status`: Optional, boolean

### Booking Creation
- `service_id`: Required, must exist in services table
- `date`: Required, valid date, today or future date

## Development Guidelines

### Code Style
- Follow PSR-12 coding standards
- Use meaningful variable and method names
- Implement proper error handling
- Write comprehensive comments

### Best Practices
- Use helper classes for business logic
- Implement request validation for all endpoints
- Use Laravel's built-in features (Eloquent, Sanctum, etc.)
- Write tests for critical functionality

## Troubleshooting

### Common Issues

#### Database Connection Error
- Verify database credentials in `.env`
- Ensure MySQL service is running
- Check database exists

#### Authentication Issues
- Verify Sanctum configuration
- Check token expiration
- Ensure proper middleware setup

#### Validation Errors
- Check request format matches API documentation
- Verify required fields are included
- Ensure data types match validation rules

## API Testing with Postman

### Setup
1. Import the API endpoints into Postman
2. Set base URL: `http://localhost:8000/api`
3. Configure authentication with Bearer token

### Testing Flow
1. Register a new user or login with existing credentials
2. Copy the received token
3. Use token for authenticated requests
4. Test all endpoints with proper data

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/new-feature`)
3. Commit your changes (`git commit -am 'Add new feature'`)
4. Push to the branch (`git push origin feature/new-feature`)
5. Create a Pull Request

### Development Setup
```bash
# Install development dependencies
composer install --dev

# Run code style checks
./vendor/bin/phpcs

# Run tests before committing
php artisan test
```



## Support

For support and questions:
- Create an issue on GitHub
- Check the documentation
- Review the API endpoints and examples

## Changelog

### Version 1.0.0
- Initial release
- User authentication system
- Service management
- Booking functionality
- Admin panel features
- Unit testing implementation

---

**Note**: This is a development version. For production deployment, ensure proper security configurations, environment variables, and server setup.