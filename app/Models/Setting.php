<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Setting extends Model
{
    use HasFactory;
    protected $fillable=['main_image','logo','title_en','title_ar','description_en','description_ar','keyword_en','keyword_ar'];
}

