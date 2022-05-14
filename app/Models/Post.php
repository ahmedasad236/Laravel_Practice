<?php
namespace App\Models;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;




class Post {
    public static function find($slug) {
        $path = __DIR__."/../../resources/posts/{$slug}.html";
        if(!file_exists($path)) {
            abort(404);
        }
        return cache()->remember("posts.{$slug}", 5, fn() => file_get_contents($path));

    }
    
    public static function all() {
        $files = File::files(__DIR__."/../../resources/posts/");
        
        return array_map(fn($file) => $file->getContents(), $files);
    }
    
}