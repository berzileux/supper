<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $key = $request->input('key');
        $value = $request->input('value');

        // Save data to in-memory cache
        Cache::put($key, $value, 60); // 60 minutes expiration


        $stored = Cache::get($key);

        return response()->json(['status' => 'success', 'key'=> $key,  'value'=> $value, 'stored'=>$stored, 'message' => 'Data saved to cache successfully.']);
    }

    public function get($key)
    {
        if (Cache::has($key) ) {
            $value = Cache::get($key);
            return response()->json(['status' => 'success', 'value' => $value]);
        }


        return response()->json(['status' => 'failed', 'message' => "Key not found"], 404);
    }

    public function update($key,$value)
    {
        if (Cache::has($key)) {
            Cache::put($key, $value, 60); // 60 minutes expiration
            return response()->json(['message' => 'Cache item updated successfully.'], 200);
        } else {
            return response()->json(['message' => 'Cache item not found.', 'key'=>$key, 'value'=>$value], 404);
        }
    }


    public function destroy($key)
    {
        if (Cache::has($key)) {
            Cache::forget($key);
            return response()->json(['message' => 'Cache item deleted successfully.'], 200);
        } else {
            return response()->json(['message' => 'Cache item not found.'], 404);
        }
    }


}
