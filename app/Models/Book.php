<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory,SoftDeletes;

protected $fillable = ['title','author','published_year','image','category_id','description','pdf','ispremium'];

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
            1 => 'Fiction',
            2 => 'Non-Fiction',
            3 => 'Science',
            4 => 'Biography',
            5 => 'Fantasy',
            6 => 'History',
            7 => 'Romance',
            8 => 'Horror',
            9 => 'Thriller',
            10 => 'Mystery',
           // 11 => 'Poetry',
           // 12 => 'Travel'
        ];
        }
}
