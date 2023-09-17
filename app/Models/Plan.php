<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    public function plan(){
        return $this->hasMany(Subscription::class);
    }

    protected $fillable = ["plan_name","price","plan_duration"];
}
