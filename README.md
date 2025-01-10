# supper

# myform

```
cd ./exercise1/myapi
npm run dev

Reference:
./myform/src/app/page.js
```

# myapi

```
cd ./exercise1/myapi
php artisan serve

curl -X POST http://localhost:8000/posts -H "Content-Type: application/json" -d '{"key":"1", "value":"apple"}'
curl -X GET http://localhost:8000/posts/1
curl -X PUT http://localhost:8000/posts/1/orange
curl -X GET http://localhost:8000/posts/1
curl -X DELETE http://localhost:8000/posts/1

Reference:
./myapi/app/Http/Controllers/PostController.php
```


