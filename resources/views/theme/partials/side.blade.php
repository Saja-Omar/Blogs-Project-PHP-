
@php
use App\Models\Blog;
use App\Models\Category;

  $data=Category::get();
  $recent=Blog::orderBy('created_at','desc')->take(3)->get();
@endphp
<!-- Start Blog Post Siddebar -->
<div class="col-lg-4 sidebar-widgets">
  <div class="widget-wrap">
      <div class="single-sidebar-widget newsletter-widget">
          <h4 class="single-sidebar-widget__title">Newsletter</h4>
          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif
          <form action="{{ route('subscriber.store') }}" method="post">
              @csrf
              <div class="form-group mt-30">
                  <div class="col-autos">
                      <input type="text" name="email" class="form-control" id="inlineFormInputGroup"
                          placeholder="Enter email" value="{{ old('email') }}" onfocus="this.placeholder = ''"
                          onblur="this.placeholder = 'Enter email'">
                      @error('email')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                  </div>
              </div>
              <button type="submit" class="bbtns d-block mt-2 w-100">Subcribe</button>
          </form>
      </div>

            <div class="single-sidebar-widget post-category-widget">
              <h4 class="single-sidebar-widget__title">Catgory</h4>
              <ul class="cat-list mt-20">
                @if (isset($data) && count($data)>0)
                   @foreach ($data as $value)
                   <li>
                    <a href="{{route('theme.category',['id'=>$value->id])}}" class="d-flex justify-content-between">
                      <p>{{$value->name}}</p>
                      <p>({{count($value->blogs)}})</p>
                    </a>
                  </li>
                   @endforeach
                @endif
               
            
              </ul>
            </div>
              @if (count($recent)>0)
              @foreach ($recent as $rec)
              <div class="single-sidebar-widget popular-post-widget">
                <h4 class="single-sidebar-widget__title">Recent Blogs</h4>
                <div class="popular-post-list">
                  <div class="single-post-list">
                    <div class="thumb">
                      <img class="card-img rounded-0" src="{{asset('storage')}}/blogs/{{$rec->image}}" alt="">
                      <ul class="thumb-info">
                        <li><a href="#">{{$rec->user->name}}</a></li>
                        <li><a href="#">{{$rec->created_at->format('d M Y')}}</a></li>
                      </ul>
                    </div>
                    <div class="details mt-20">
                      <a href="{{route('blogs.show',['blog'=>$rec])}}">
                        <h6>{{$rec->name}}</h6>
                      </a>
                    </div>
                  </div>
              @endforeach
           
                </div>
              </div>
              @endif
            
          </div>
      </div>
      <!-- End Blog Post Siddebar -->