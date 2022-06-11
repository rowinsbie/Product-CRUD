<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductFile extends Model
{
    use HasFactory;
    
    static function Upload($file)
    {
        Storage::disk('products')->put('images',$file);
    }

}
