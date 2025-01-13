# supper

# nextjs-simple

```
cd ./nextjs-simple
npm run dev

Reference:
./pages
./components
```

# myapi (lavarel)

```
cd ./myapi
php artisan serve

curl -X POST http://localhost:8000/api/posts -H "Content-Type: application/json" -d '{"key":"1", "value":"apple"}'
curl -X GET http://localhost:8000/api/posts/1
curl -X PUT http://localhost:8000/api/posts/1/orange
curl -X GET http://localhost:8000/api/posts/1
curl -X DELETE http://localhost:8000/api/posts/1

Reference:
./myapi/app/Http/Controllers/PostController.php
```


