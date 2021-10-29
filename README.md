BIGFISH user api próbafeledat.

1. Create a database.
2. Set up the db attributes in .env file.
3. Run migrations, and seeders (command: php artisan migrate --seed).
4. Necessary api endpoints:
   1. GET: /api/users
   2. GET: /api/users/{id}
   3. GET: api/users/search/{name}
   4. POST: /api/users/
      1. attributes: name,email,date_of_birth,phone[number]
   5. GET: /api/phones
   6. POST: /api/phones/
      1. attributes: user_id, number

