# Street Listings — Project Context

## Codebase conventions

This app has no separate JSON API. Controllers return `Inertia::render(...)`
with props; API Resources (`ListingResource`, `BranchResource`) define the
shape of those props. Follow this shape for any new page or data the
frontend needs — don't introduce a parallel REST/JSON endpoint style unless
there's a good reason (e.g. this alerts feature may justify one — note the
trade-off if so).

- **Routing**: `routes/web.php`, resolves to `Inertia::render`.
- **Resources**: shape data going to the frontend. One Resource per model
  concept, matching `ListingResource` / `BranchResource`.
- **Enums**: domain vocabularies (`PropertyType`, `ListingStatus`) live in
  `app/Enums/`. Use PHP enums, not magic strings.
- **Validation**: Form Requests (`app/Http/Requests/`), not inline
  controller validation — see `ListingIndexRequest`.
- **Auth**: stubbed via `App\Http\Middleware\ActAsDemoUser`. Always build
  against `auth()->user()` / `$request->user()`.
- **Filters/state**: query-string driven where relevant, so state is
  shareable and bookmarkable.
- **Frontend**: Vue 3 + Tailwind, pages in `resources/js/pages/`,
  reusable pieces in `resources/js/components/`.

Checks before considering work done:

php artisan test
vendor/bin/pint --test
vendor/bin/phpstan analyse


## Saved-search alerts feature — the brief

1. A user can **create, view, and delete saved searches** — a set of
   criteria (e.g. max price, min bedrooms, property type, region).
2. When a **new listing becomes live** matching a saved search, an
   **alert** is generated for that user.
3. A user can **see their alerts**.

Constraints: no real emails, no queue worker required — a persisted alert
record or log/database-driver notification is enough (describe a queue
design if implied, don't build it). Auth is stubbed — build against
`auth()->user()`. Prioritise a clean, well-tested vertical slice over
breadth — don't gold-plate.

Open decisions to make explicitly (state the call + one-line reasoning in
code comments or NOTES.md, don't pick silently):
- What counts as a "match"?
- Backfill: alert on already-live matches, or only future listings?
- Duplicate alerts: one per user, or one per matching saved search?
- Criteria set: max price vs. range, which filters to support.
- Anti-spam: Support flagged this explicitly — avoid re-alerting on
  unchanged matches.

Definition of done: tests assert behaviour that matters (matching logic,
alert creation, saved-search CRUD); `NOTES.md` at repo root covers key
decisions, trade-offs, what was left out, what's next, where it'd break at
scale; work on a branch, PR against your own fork.
