# Irrigoo

Irrigoo is a smart IoT irrigation ecosystem built with Laravel. It connects farmers, irrigation service providers, and IoT device manufacturers in one platform so farms can monitor water usage, control irrigation devices, request services, and discover smart irrigation hardware.

GitHub Repository: [SaurabhVishwakarma412/Irrigoo](https://github.com/SaurabhVishwakarma412/Irrigoo)

## Project Overview

Irrigoo is designed for modern agriculture where irrigation decisions can be supported by sensor readings, local weather, service availability, and device management. The platform provides role-based dashboards for each stakeholder:

- Farmers can monitor assigned smart devices, view sensor data, toggle irrigation, track water usage, receive weather-based irrigation advice, and request services.
- Service providers can publish irrigation services, manage incoming farmer requests, update request status, purchase manufacturer devices, and track completed work and earnings.
- Manufacturers can register IoT irrigation devices, manage product catalogs, view product sales, and make devices available to providers.

## Key Features

- Role-based authentication for farmers, providers, and manufacturers.
- Farmer dashboard with active devices, water usage, service recommendations, and request history.
- Smart irrigation toggle for assigned farmer devices.
- Sensor data simulation and API fetch endpoints for recent readings.
- Weather-based irrigation advice using Open-Meteo geocoding and forecast APIs.
- Provider dashboard for service publishing, request management, completed jobs, and earnings.
- Device purchase workflow for providers.
- Manufacturer dashboard for IoT device registration and sales tracking.
- Profile management powered by Laravel Breeze.
- Responsive Blade UI styled with Tailwind CSS and Alpine.js.

## Tech Stack

- Backend: Laravel 12, PHP 8.2
- Frontend: Blade, Tailwind CSS, Alpine.js, Vite
- Database: MySQL
- Authentication: Laravel Breeze
- APIs: Open-Meteo weather and geocoding APIs
- Testing: PHPUnit

## Main Modules

### Farmer

Farmers can register with farm details such as location, crop type, farm name, and farm size. The farmer dashboard shows connected devices, water usage, irrigation status, recommended local services, and recent service requests.

Important actions:

- View assigned IoT irrigation devices.
- Start or stop irrigation.
- Fetch or simulate sensor data.
- Request installation, maintenance, repair, consultation, or monitoring services.
- View weather-informed irrigation advice.

### Service Provider

Providers can register their organization and service area. Their dashboard helps them publish services, handle farmer requests, and review business performance.

Important actions:

- Add new services.
- Delete published services.
- Accept, complete, reject, or keep service requests pending.
- Purchase devices listed by manufacturers.
- Track pending requests, completed jobs, and total earnings.

### Manufacturer

Manufacturers can register IoT irrigation products and make them visible to providers. The dashboard also shows sales generated through provider purchases.

Important actions:

- Register devices with price, connectivity, power source, coverage area, target crops, and features.
- View device catalog.
- Track recent product sales.
- Browse services published by providers.

## Important Routes

| Area | Route | Description |
| --- | --- | --- |
| Public | `/` | Landing page |
| Public | `/about` | About page |
| Public | `/contact` | Contact page |
| Auth | `/register` | User registration |
| Auth | `/login` | User login |
| Dashboard | `/dashboard` | Redirects users to their role-specific dashboard |
| Farmer | `/farmer/dashboard` | Farmer dashboard |
| Provider | `/provider/dashboard` | Provider dashboard |
| Provider | `/provider/purchases` | Provider device purchases |
| Manufacturer | `/manufacturer/dashboard` | Manufacturer dashboard |
| Profile | `/profile` | User profile settings |

## Database Tables

The project includes migrations for:

- users
- farmer_profiles
- provider_profiles
- manufacturer_profiles
- devices
- farmer_devices
- sensor_data
- services
- service_requests
- device_purchases
- cache and jobs tables

## Installation

### Prerequisites

Make sure these are installed:

- PHP 8.2 or higher
- Composer
- Node.js and npm
- MySQL

### Setup Steps

Clone the repository:

```bash
git clone https://github.com/SaurabhVishwakarma412/Irrigoo.git
cd Irrigoo
```

Install PHP dependencies:

```bash
composer install
```

Install frontend dependencies:

```bash
npm install
```

Create the environment file:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

Configure your database in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=irrigation_system_db
DB_USERNAME=root
DB_PASSWORD=
```

Run migrations:

```bash
php artisan migrate
```

Start the Laravel development server:

```bash
php artisan serve
```

In another terminal, start Vite:

```bash
npm run dev
```

Open the app at:

```text
http://127.0.0.1:8000
```

## Useful Commands

Run frontend build:

```bash
npm run build
```

Run tests:

```bash
php artisan test
```

Run the combined development workflow defined in `composer.json`:

```bash
composer run dev
```

## Environment Notes

- The app uses MySQL by default with the database name `irrigation_system_db`.
- Weather advice depends on external Open-Meteo API calls.
- Authentication and profile pages are based on Laravel Breeze.
- User registration supports three roles: `farmer`, `provider`, and `manufacturer`.

## Project Structure

```text
app/
  Http/Controllers/        Application and role-specific controllers
  Models/                  Eloquent models for users, devices, services, and requests
  Services/WeatherService.php
database/migrations/       Database schema files
resources/views/           Blade templates for public pages and dashboards
routes/web.php             Web routes and role-based dashboard routing
routes/auth.php            Authentication routes
public/                    Public assets
```

## Future Improvements

- Add real IoT device integration instead of simulated sensor readings.
- Add notifications for service request status changes.
- Add admin review or verification workflows if required.
- Add charts for sensor history and water usage trends.
- Add payment integration for device purchases and service completion.

## License

This project is open-source and available under the MIT License.
