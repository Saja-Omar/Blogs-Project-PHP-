@extends('theme.master')
@section('title','Home')
@section('home.active','active')
@section('content')


<body>
  <!--================Header Menu Area =================-->

  <!--================Header Menu Area =================-->
  
  <main class="site-main">
    <!--================Hero Banner start =================-->  
    <section class="mb-30px">
      <div class="container">
        <div class="hero-banner">
          <div class="hero-banner__content">
            <h3>Tours & Travels</h3>
            <h1>Amazing Places on earth</h1>
            <h4>December 12, 2018</h4>
          </div>
        </div>
      </div>
    </section>
    <!--================Hero Banner end =================-->  

    <!--================ Blog slider start =================-->  
    <section>
      <div class="container">
        <div class="owl-carousel owl-theme blog-slider">
          @if (count($recent_data)>0)
            @foreach ($recent_data as $recent)
            <div class="card blog__slide text-center">
              <div class="blog__slide__img">
                <img class="card-img rounded-0" src="{{asset('storage')}}/blogs/{{$recent->image}}" alt="" height="250px">
              </div>
              <div class="blog__slide__content">
                <a class="blog__slide__label" href="{{route('theme.category',['id'=>$recent->id])}}">{{$recent->category->name}}</a>
                <h3><a href="{{route('blogs.show',['blog'=>$recent->id])}}">{{$recent->name}}</a></h3>
                <p>{{$recent->created_at->format('d M Y')}}</p>
              </div>
            </div>
            @endforeach
          @endif
          
        </div>
      </div>
    </section>
    <!--================ Blog slider end =================-->  

    <!--================ Start Blog Post Area =================-->
 
    <section class="blog-post-area section-margin mt-4">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            @if (count($data)>0)
              @foreach ($data as $value)
              <div class="single-recent-blog-post">
                <div class="thumb">
                  <img class="img-fluid" src="{{asset('storage')}}/blogs/{{$value->image}}" alt="" style="width: 500px; height: 300px;">
                  <ul class="thumb-info">
                    <li><a href="#"><i class="ti-user"></i>{{$value->user->name}}</a></li>
                    <li><a href="#"><i class="ti-notepad"></i>{{$value->created_at->format('d M Y')}}</a></li>
                    <li><a href="#"><i class="ti-themify-favicon"></i>2 Comments</a></li>
                  </ul>
                </div>
                <div class="details mt-20">
                  <a href="{{route('blogs.show',['blog'=>$value])}}">
                    <h3>{{$value->name}}</h3>
                  </a>
                  <!-- Displaying only part of the article -->
                  <p>{{ Str::limit($value->description, 150) }}</p>
                  <a class="button" href="{{ route('blogs.show', ['blog' => $value]) }}">Read More <i class="ti-arrow-right"></i></a>
                </div>
              </div>
              @endforeach
            @endif
            <div class="row">
              <div class="col-lg-12">
                {{ $data->links('pagination::bootstrap-4') }}
              </div>
            </div>
          </div>
          
          @include('theme.partials.side')
        </div>
      </div>
    </section>
    
    <!--================ End Blog Post Area =================-->
  </main>

  <!--================ Start Footer Area =================-->

  <!--================ End Footer Area =================-->

</body>
</html>
@endsection  


