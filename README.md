# Mass Rescue 🪖 🔥 🚓

A PHP-based emergency response management system designed to coordinate and streamline rescue operations during mass casualty incidents.

## 📋 Table of Contents
- [Requirements](#-requirements)
- [Features](#-features)
- [Architecture](#-architecture)
- [Project Documentation](#-project-documentation)
  - [Home](#home)
  - [Events](#events)
  - [Event](#event)
- [Technical Stack](#-technical-stack)

## 📙 Requirements

* PHP 7.3.33 or higher
* [Composer](https://getcomposer.org) for dependency management
* MySQL database
* Apache web server

## ✨ Features

- User authentication and authorization
- Emergency event management
- Force/resource management
- Real-time incident tracking
- Resource allocation
- Emergency response team coordination

## 🏗️ Architecture

### System Overview
Mass Rescue follows a traditional MVC (Model-View-Controller) architecture:

```
┌─────────────────┐     ┌─────────────────┐     ┌─────────────────┐     ┌─────────────────┐
│      Views      │     │   Controllers   │     │     Models      │     │    Database     │
│   (Interface)   │◄───►│     (Logic)     │◄───►│    (Laravel)    │◄───►│     (MySQL)     │
└─────────────────┘     └─────────────────┘     └─────────────────┘     └─────────────────┘
```

## 📚 Project Documentation

### Home

#### HomeController
- Handles main application views and navigation
- Manages user dashboard and overview
- Key methods:
  - `index()`: Main dashboard view
  - `create()`: Create new user
  - `users()`: List all users
  - `login()`: User authentication
  - `logout()`: User session termination

#### Home Views
- `index.php`: Main dashboard view
- `create.php`: User creation form
- `users.php`: Users listing and management
- `login.php`: User authentication form
- `logout.php`: Session termination

#### User Model
```php
class User extends Eloquent {
	protected $primaryKey = 'user_id';
	public $incrementing = true;
	protected $nullable = ['session_id', 'force_id'];
	public $user_id;
	public $session_id;
	public $id_number;
	public $first_name;
	public $last_name;
	public $password;
	public $role;

	public $timestamps = true;
	protected $fillable = ['session_id', 'force_id', 'id_number', 'first_name', 'last_name', 'password'];
	protected $hidden = ['session_id', 'password'];
}
```
- Manages user authentication and authorization
- Fields:
  - `user_id`: Primary key
  - `session_id`: User session identifier
  - `force_id`: Associated force/resource
  - `id_number`: User identification number
  - `first_name`: User's first name
  - `last_name`: User's last name
  - `password`: plain text password
  - `role`: User role/permissions

---

### Events

#### EventsController
- Manages multiple events and event listings
- Handles event filtering and search
- Key methods:
  - `index()`: Events listing
  - `create()`: Create new event
  - `eventById()`: Get specific event details
  - `eventsList()`: List all events
  - `update()`: Update event information
  - `remove()`: Remove event

#### Event Views
- `index.php`: Main events overview
- `create.php`: Event creation form
- `event.php`: Individual event details
- `list.php`: Events listing page
- `update.php`: Event editing interface
- `remove.php`: Event deletion confirmation

#### Event Model
```php
class Event extends Eloquent {
	protected $primaryKey = 'event_id';
	public $incrementing = true;
	public $title;
	public $subtitle;
	public $type;
	public $latitude;
	public $longitude;

	public $timestamps = true;
	protected $fillable = ['title', 'subtitle', 'type', 'latitude', 'longitude'];
}
```
- Manages emergency events/incidents
- Fields:
  - `event_id`: Primary key
  - `title`: Event title
  - `subtitle`: Event description
  - `type`: Event type/category
  - `latitude`: Event location latitude
  - `longitude`: Event location longitude

---

### Event

#### EventController
- Manages individual event operations
- Handles event creation, updates, and deletion
- Key methods:
  - `index()`: Main event view
  - `create()`: New event creation
  - `forceById()`: Get specific force details
  - `forcesList()`: List all forces for an event
  - `updateForce()`: Update force information
  - `removeForce()`: Remove force from event

#### Event Views
- `index.php`: Force management dashboard
- `create.php`: Force creation form
- `force.php`: Individual force details
- `list.php`: Forces listing for an event
- `update.php`: Force editing interface
- `remove.php`: Force removal confirmation

#### Force Model

```php
class Force extends Eloquent {
	protected $primaryKey = 'force_id';
	public $incrementing = true;
	protected $nullable = ['event_id'];
	public $force_id;
	public $event_id;
	public $title;
	public $subtitle;
	public $type;
	public $latitude;
	public $longitude;

	public $timestamps = true;
	protected $fillable = ['event_id', 'title', 'subtitle', 'type', 'latitude', 'longitude'];
}
```
- Manages emergency response forces/resources
- Fields:
  - `force_id`: Primary key
  - `event_id`: Associated event
  - `title`: Force name
  - `subtitle`: Force description
  - `type`: Force type/category
  - `latitude`: Force location latitude
  - `longitude`: Force location longitude

## 💻 Technical Stack

### Backend
- PHP 7.3.33
- Laravel's Illuminate Database Component
- MySQL Database
- Apache Web Server

### Project Structure
```
mass-rescue/
├── app/
│   ├── controllers/    # Application controllers
│   ├── models/        # Data models
│   ├── views/         # View templates
│   ├── core/          # Core framework components
│   ├── database.php   # Database configuration
│   └── init.php       # Application initialization
├── public/            # Publicly accessible files
└── composer.json      # Project dependencies
```
