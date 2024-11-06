<?php
//one category->many blogs 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable=['name'];
  
        public function Blogs()
        {
            return $this->hasMany(Blog::class);
        }
    
}
