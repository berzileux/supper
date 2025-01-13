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
        Cache::put($key, $value, 6000000); // 60 minutes expiration

        // internal mechanism to cache..basic
        $keys = Cache::get('cache_keys', []);
        $keys[] = $key;
        Cache::forever('cache_keys', $keys);

        return response()->json(['status' => 'success', 'key'=> $key,  'value'=> $value, 'message' => 'Data saved to cache successfully.']);
    }

    public function list()
    {
            // Get key list
            $keys = Cache::get('cache_keys', []);

            // Retrieve all cache items
            $cacheData = [];
            foreach ($keys as $key) {
                $cacheData[$key] = Cache::get($key);
            }

            return response()->json(['status' => 'success', 'message' => $cacheData]);
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


    public function forget($key)
    {
        if (Cache::has($key)) {
            Cache::forget($key);

            // Get existing key list
            $keys = Cache::get('cache_keys', []);
            $keys = array_diff($keys, [$key]);
            // Save updated key list
            Cache::forever('cache_keys', $keys);

            return response()->json(['message' => 'Cache item deleted successfully.'], 200);
        } else {
            return response()->json(['message' => 'Cache item not found.'], 404);
        }
    }


}
