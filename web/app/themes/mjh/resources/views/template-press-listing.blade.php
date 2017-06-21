{{--
  Template Name: Press Listing
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
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
      
      @if ($get_max_num_pages)
        @include('partials.pagination',['max_num_pages'=>$get_max_num_pages])
      @endif

  @endwhile
@endsection
