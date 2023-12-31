<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title_en','title_ar','country','published'];
    
    public function products() {
        return $this->hasMany(Product::class);
    }

    
}
