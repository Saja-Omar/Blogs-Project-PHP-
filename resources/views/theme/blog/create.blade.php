@php
use App\Models\Category;

$data = Category::all();
@endphp
@extends('theme.master')

@section('title', 'Write Your Blog Post')

@section('content')
<body>

  <style>
      #description {
          height: 200px; /* تعديل الارتفاع كما تراه مناسبًا */
          resize: vertical; /* يمكن للمستخدم تغيير الحجم عموديًا فقط */
      }
  </style>

  <!--================ Hero sm banner start =================-->  
  @include('theme.partials.hero', ['title' => 'Add New Blog'])
  <!--================ Hero sm banner end =================-->  

  <!-- ================ contact section start ================= -->
  <section class="section-margin--small section-margin">
    <div class="container">
      <div class="row">
        <div class="col-12">
          @if (session('Blog_sate'))
          <div class="alert alert-success">
              {{ session('Blog_sate') }}
          </div>
      @endif
         
          <form action="{{ route('blogs.store') }}" class="form-contact contact_form" method="post" novalidate="novalidate" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
              <input class="form-control border" name="name" id="name" type="text" placeholder="Enter your blog title" value="{{ old('name') }}">
              <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="form-group">
              <input class="form-control border" name="image" id="image" type="file">
              <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>

            <div class="form-group">
              <select class="form-control border" name="category_id" id="category_id">
                <option value="">Select Category</option>
                @if (count($data) > 0)
                    @foreach ($data as $val)
                        <option value="{{ $val->id }}">{{ $val->name }}</option>
                    @endforeach
                @endif
              </select>
              <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
            </div>

            <div class="form-group">
                <textarea class="form-control border" name="description" id="description" rows="5" placeholder="Enter your blog description">{{ old('description') }}</textarea>
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
