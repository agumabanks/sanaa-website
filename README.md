# Sanaa Website

This project powers the main website for **Sanaa**, an ecosystem of products ranging from media to finance.
It is built with [Laravel](https://laravel.com/) and uses Jetstream for authentication.

## Features

- Blog system with basic CRUD abilities
- Dynamic product listing pulled from Soko 24
- Placeholder pages for company information, services and more

## Contact Form Rate Limiting

The `/contact` endpoint is protected by Laravel's `throttle` middleware and allows up to five submissions per minute per IP address. Users who exceed this limit will receive a **429 Too Many Requests** response and should wait before trying again.

## Upcoming Menu Items

- [ ] Ai branding
- [ ] Customer care automation
- [ ] Wa services
- [ ] Prices
- [ ] Print on damand
- [ ] Saas /softwares
- [ ] Soko 24 shop now
- [ ] Buy a Sanaa card

## Setup

1. Install PHP dependencies:
   ```bash
   composer install
   ```
2. Copy `.env.example` to `.env` and set your environment variables. The Google Maps and Firebase keys are stored in `GOOGLE_MAPS_KEY` and the `FIREBASE_*` variables.
3. Generate an application key:
   ```bash
   php artisan key:generate
   ```
4. Run the migrations and seeders:
   ```bash
   php artisan migrate --seed
   ```
5. Start the local development server:
   ```bash
   php artisan serve
   ```

## Analytics

Firebase analytics is optional and loaded only on pages that opt in. To enable it for a Blade view that extends `layouts.app`, declare an empty `analytics` section:

```blade
@extends('layouts.app')

@section('analytics')
@endsection
```

The layout detects this section and dynamically imports the Firebase SDK after `DOMContentLoaded`, ensuring that analytics does not block page rendering.

## Testing

Run the automated test suite with:

```bash
composer test
```
