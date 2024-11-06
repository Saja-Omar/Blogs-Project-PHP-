<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
   public function index(){
    $data = Blog::paginate(4); // استخدم paginate بدلاً من pagination
       return view('theme.index', compact('data')); // تمرير البيانات إلى العرض

   }
   public function category($id){
         $data=Blog::where('category_id',$id)->paginate(4);

        
         $d=Category::find($id)->name;
         
          return view('theme.category',compact('data','d'));
    }
    public function contact(){
        return view('theme.contact');
    }


 
     public function login(){
      return view('theme.login');
      }
      public function register(){
          return view('theme.register');
      }

}
