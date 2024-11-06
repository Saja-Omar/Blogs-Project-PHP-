@extends('theme.master')

@section('title', 'Login Page')

@section('content')
<body>
  
  <!--================ Hero sm banner start =================-->  
  @include('theme.partials.hero', ['title' => 'Login'])

  <!--================ Hero sm banner end =================-->  

  <!-- ================ contact section start ================= -->
  <section class="section-margin--small section-margin">
    <div class="container">
      <div class="row">
        <div class="col-6 mx-auto">
          <form action="{{ route('login') }}" class="form-contact contact_form" action="contact_process.php" method="post"  novalidate="novalidate">
            @csrf
            <div class="form-group">
              <input class="form-control border" name="email" id="email" type="email" placeholder="Enter email address"
              value="{{old('email')}}">
              <x-input-error :messages="$errors->get('email')" class="mt-2" />

            </div>
            <div class="form-group">
              <input class="form-control border" name="password" id="password" type="password" placeholder="Enter your password">
           
              <x-input-error :messages="$errors->get('password')" class="mt-2" />
              </div>
            <div class="form-group text-center text-md-right mt-3">
              <button type="submit" class="button button--active button-contactForm">Login</button>
            </div>
          </form>
          <div class="text-center mt-3">
            <p>Don't have an account? <a href="{{route('register')}}" class="text-primary">Sign up here</a></p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ================ contact section end ================= -->

</body>
</html>
@endsection
