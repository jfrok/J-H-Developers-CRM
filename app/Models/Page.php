<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
//protected $fillable = ['page_id'];
 public function scripts()
 {
     return $this->hasMany(Script::class);
 }
}
