{{--
  Template Name: Press Listing
--}}

@extends('layouts.app')
@section('content')
  <div class="row">
    @if (App::getPressStickyPosts())
      @include('partials.content-side-press-listing')
    @endif
    @while(have_posts()) @php(the_post())
          <div class="press-content-main col-md-6 @if (!App::getPressStickyPosts()) offset-md-3 @endif"> 
            @include('partials.content-page')
            @if($press)
              @foreach ($press as $press_group)
                @include('partials.content-press-listing', ['press_group'=>$press_group])
              @endforeach
            @else
              <div style="margin-bottom: 100px;">
                <div class="alert alert-warning">
                  @php _e("There are no press posts to display","sage"); @endphp
                </div>
                {!! get_search_form(false) !!}
              </div>
            @endif
          </div>

        @if ($get_max_num_pages)
          @include('partials.pagination',['max_num_pages'=>$get_max_num_pages])
        @endif

    @endwhile
  </div>
@endsection
