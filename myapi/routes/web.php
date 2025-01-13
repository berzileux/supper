<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Http\Controllers\PostController;

// curl -X POST http://localhost:8001/posts -H "Content-Type: application/json" -d '{"key":"1", "value":"apple"}'
Route::post('/api/posts', [PostController::class, 'store']);


// curl http://localhost:8001/api/posts/list
Route::get('/api/posts/lists', [PostController::class, 'list']);


// curl http://localhost:8001/posts/1
Route::get('/api/posts/{id}', [PostController::class, 'get']);

// curl -X PUT http://localhost:8001/posts/1/orange
Route::put('/api/posts/{id}/{value}', [PostController::class, 'update']);


// curl -X DELETE http://localhost:8001/posts/1
Route::delete('/api/posts/{id}', [PostController::class, 'forget']);

Route::get('/', function () {
    return "Welcome REST-API";
});

Route::get('/api/hello', function (Request $request) {
        $data = [
            'message' => 'Hello, World!',
            'status' => 'success'
        ];

        return response()->json($data);
});
