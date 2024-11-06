@extends('theme.master')

@section('title', 'My Blogs')

@section('content')
<body>

  <style>
      #description {
          height: 200px; /* تعديل الارتفاع كما تراه مناسبًا */
          resize: vertical; /* يمكن للمستخدم تغيير الحجم عموديًا فقط */
      }
  </style>

  <!--================ Hero sm banner start =================-->  
  @include('theme.partials.hero', ['title' => 'My Blogs'])
  <!--================ Hero sm banner end =================-->  

  <!-- ================ contact section start ================= -->
  <section class="section-margin--small section-margin">
    <div class="container">
      <div class="row">
        <div class="col-12">
            @if (session('delete_sr'))
            <div class="alert alert-success">
                {{ session('delete_sr') }}
            </div>
            @endif

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col" width="15%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($blogs->count() > 0)
                        @foreach ($blogs as $blog)
                        <tr>
                            <td>
                                <a href="{{ route('blogs.show', ['blog' => $blog]) }}" target="_blank">
                                    {{ $blog->name }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('blogs.edit', ['blog' => $blog]) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                                <form action="{{ route('blogs.destroy', ['blog' => $blog]) }}" method="post" id="delete_form_{{ $blog->id }}" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <a href="javascript:void(0);" onclick="confirmDelete('{{ $blog->name }}', {{ $blog->id }})" class="btn btn-sm btn-danger mr-2">Delete</a>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="2" class="text-center">No blogs found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>

            @if ($blogs->count() > 0)
                {{ $blogs->links('pagination::bootstrap-4') }}
            @endif
        </div>
      </div>
    </div>
  </section>
  <!-- ================ contact section end ================= -->

  <script>
      function confirmDelete(blogName, blogId) {
          if (confirm('Are you sure you want to delete the blog titled "' + blogName + '"?')) {
              document.getElementById('delete_form_' + blogId).submit();
          }
      }
  </script>

</body>
@endsection
