<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable=['name','description','image','category_id','user_id'];
    public function Category()
        {
            return $this->belongsTo(Category::class);
        }
       
        public function User()
        {
            return $this->belongsTo(User::class);
        }
        
        public function Comments()
        {
            return $this->hasMany(Comment::class);
        }
        



}