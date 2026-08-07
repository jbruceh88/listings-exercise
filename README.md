# Street Listings

A small property-listings application: a Laravel 13 API with a Vue 3 front end. It lists properties for sale, organised by branch, with filtering and a detail view.

This repository is the starting point for a technical exercise. **Your task is described in [`TASK.md`](TASK.md).** This README covers what's here and how to run it.

## Requirements

- PHP 8.4
- Composer
- Node 20+ and npm
- SQLite (bundled with PHP — no separate database server needed)

## Getting started

```bash
# 1. Install dependencies
#    composer install also creates .env from .env.example (if missing),
#    creates database/database.sqlite, and sets APP_KEY when it's blank.
composer install
npm install

# 2. Database — migrate and seed
php artisan migrate --seed

# 3. Run — in two terminals, or use the combined dev script
php artisan serve      # API + app at http://127.0.0.1:8000
npm run dev            # Vite dev server for the front end
```

Then open <http://127.0.0.1:8000>.

## Running the checks

```bash
php artisan test              # PHPUnit feature/unit tests
vendor/bin/pint --test        # Code style (Laravel Pint)
vendor/bin/phpstan analyse    # Static analysis (Larastan, level 5)
```

All three run in CI (`.github/workflows/ci.yml`) on push and pull request, and all pass on a fresh clone.

## How it's laid out

```
app/
  Enums/                 PropertyType, ListingStatus
  Http/
    Controllers/         ListingController
    Requests/            ListingIndexRequest (filter validation)
    Resources/           ListingResource, BranchResource
    Middleware/          ActAsDemoUser (auth stub — see below)
                         HandleInertiaRequests (shared props)
  Models/                Branch, Listing
database/
  factories/             BranchFactory, ListingFactory (with states)
  migrations/            branches, listings
  seeders/               DatabaseSeeder
resources/js/
  Pages/Listings/        Index.vue, Show.vue
  Components/            AppLayout, ListingCard, ListingFilters, Pagination
  app.js                 Inertia entry point
routes/                  web.php
tests/Feature/           ListingPageTest, ListingTest
```

### The domain

- **Branch** — a name and a region.
- **Listing** — address, price, bedrooms, bathrooms, `property_type`, `status` (`draft` / `live` / `under_offer` / `sold`), a branch, and a `listed_at` date.

### The stack

Laravel + **Inertia** + Vue 3 + Tailwind — the same shape as our internal apps. There is no separate JSON API: controllers return `Inertia::render(...)` with props, and API Resources (`ListingResource`, `BranchResource`) define the shape those props take.

| Method | Path                 | Page              | Notes                                                      |
| ------ | -------------------- | ----------------- | ---------------------------------------------------------- |
| GET    | `/`                  | `Listings/Index`  | Live listings, paginated. Filters: `property_type`, `max_price`, `min_bedrooms`, `region`, `per_page`. |
| GET    | `/listings/{listing}`| `Listings/Show`   | A single live listing. Non-live listings 404.              |

Filters live in the query string, so a search is shareable, bookmarkable and survives the back button. `Listings/Index.vue` seeds its form from the `filters` prop and re-issues a `router.get` on submit.

### Authentication

Auth is **stubbed**. A real deployment would authenticate requests properly; to keep this exercise focused on the feature rather than on auth plumbing, every request is resolved as the seeded demo user (`demo@street.example`) via `App\Http\Middleware\ActAsDemoUser`, and shared to the front end as the `auth.user` prop. Build any user-scoped work against `$request->user()` / `auth()->user()` as you normally would — it will return the demo user.

Note the resolver returns `null` until the database is seeded, so run `php artisan migrate --seed` before you start.

---

Your task: **[`TASK.md`](TASK.md)**.
