<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    public function subscription(){
        return $this->belongsTo(Plan::class);
    }

    protected $fillable = ["user_id","plan_id","plan_start_date","plan_end_date","ispaid"];
}
