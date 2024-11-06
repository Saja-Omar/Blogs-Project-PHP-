<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreBlogRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateBlogRequest ;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
    {
        $this->middleware('auth')->only(['create']);

    }

    public function index()
    {
      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
           return view('theme.blog.create');   
         
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
         $data=$request->validated();
         $img=$request->image;
         $newImageName=time().'-'.$img->getClientOriginalName();
         $img->storeAs('blogs',$newImageName,'public');
         $data['image']=$newImageName;
         $data['user_id']=Auth::user()->id;
         Blog::create($data);
         return back()->with('Blog_sate','Your Blog Created Successfilly');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('theme.singleRoute',compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        if(Auth::user()->id==$blog->user_id){
            $categories=Category::get();
            return view('theme.blog.edit',compact('categories','blog'));
        }
        abort(403);     
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        if(Auth::user()->id==$blog->user_id){

        $data=$request->validated();
        if($request->hasFile('image')){
          
            Storage::disk('public')->delete('blogs/' . $blog->image); 
            $img=$request->image;
            $newImageName=time().'-'.$img->getClientOriginalName();
            $img->storeAs('blogs',$newImageName,'public');
            $data['image']=$newImageName;
            //delete imsage 
            //storage::disk('public')->delete('blogs/'.$blog->image)
        }
       $blog->update($data);
        return back()->with('update_sr','Your Blog Update Successfilly');
    }
    abort(403);     

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        if(Auth::user()->id==$blog->user_id){
            Storage::disk('public')->delete("blogs/$blog->image");
            $blog->delete();
            return back()->with('delete_sr','Your Blog Deleted Successfully');
        }
       
        abort(403);     

      
    }
    

    //display all user blogs 
    public function myBlog(Blog $blog)
    {
        if(Auth::user())
         {  $blogs=Blog::where('user_id',Auth::user()->id)->paginate(10);
            return view('theme.blog.my-blogs',compact('blogs'));
        }else{
            return redirect()->route('login');
        }
            
    }

}
