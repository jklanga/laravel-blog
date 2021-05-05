## Laravel Blog
This is a simple blog application written in Laravel 7. It allows users to register and login.
### User roles:
- Admin: Can create, list, edit, show and delete the post, as well as adding a comment.
- User: Can only list and show the post, including adding a comment to a post.

## Setup

```bash
cp .env.example .env
```

Run the migrations and seeds
```bash
php artisan migrate
php artisan db:seed
