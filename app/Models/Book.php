<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

protected $fillable = ['title','author','published_year','image','category_id','description','pdf'];

    public function book(){
        return $this->belongsTo(Category::class);
    }

    public function getCategoryidAttribute($attribute){


        if (isset($this->getCategoryid()[$attribute])) {
            return $this->getCategoryid()[$attribute];
        } else {
            return;
        }
    }
    
        public function getCategoryid()
        {
           
        return [
            1 => 'Mystery',
            2 => 'Thriller',
            3 => 'Adventure',
            4 => 'Children',
            5 => 'Fantasy',
            6 => 'Science Fiction',
            7 => 'Romance',
            8 => 'Non-Fiction',
            9 => 'Biography',
            10 => 'Auto-Biography',
            11 => 'Poetry',
            12 => 'Travel'
        ];
        }
}
