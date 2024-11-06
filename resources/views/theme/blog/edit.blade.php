@php
use App\Models\Category;

$data = Category::all();
@endphp
@extends('theme.master')

@section('title', 'Edit Blog')

@section('content')
<body>

  <style>
      #description {
          height: 200px; /* تعديل الارتفاع كما تراه مناسبًا */
          resize: vertical; /* يمكن للمستخدم تغيير الحجم عموديًا فقط */
      }
  </style>

  <!--================ Hero sm banner start =================-->  
  @include('theme.partials.hero', ['title' => $blog->name])
  <!--================ Hero sm banner end =================-->  

  <!-- ================ contact section start ================= -->
  <section class="section-margin--small section-margin">
    <div class="container">
      <div class="row">
        <div class="col-12">
          @if (session('update_sr'))
          <div class="alert alert-success">
              {{ session('update_sr') }}
          </div>
      @endif
         
          <form action="{{ route('blogs.update',['blog'=>$blog]) }}" class="form-contact contact_form" method="post" novalidate="novalidate" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
              <input class="form-control border" name="name" id="name" type="text" placeholder="Enter your blog title" value="{{$blog->name}}">
              <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="form-group">
              <input class="form-control border" name="image" id="image" type="file">
              <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>

            <div class="form-group">
              <select class="form-control border" name="category_id" id="category_id">
                <option value="">Select Category</option>
              @if (count($data)>0)
                  @foreach ($data as $value)
                  <option value="{{$value->id}}"@if ($value->id==$blog->category_id)
                   selected 
                  @endif>
                  {{$value->name}}
                  </option>
                  @endforeach
              @endif
              </select>
              <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
            </div>

            <div class="form-group">
                <textarea class="form-control border" name="description" id="description" rows="5" placeholder="Enter your blog description">{{$blog->description }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
          
            <div class="form-group text-center text-md-right mt-3">
                <button type="submit" class="button button--active button-contactForm">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- ================ contact section end ================= -->

</body>
</html>
@endsection
