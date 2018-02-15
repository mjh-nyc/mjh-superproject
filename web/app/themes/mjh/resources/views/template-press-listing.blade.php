{{--
  Template Name: Press Listing
--}}

@extends('layouts.app')
@section('content')
  <div class="row">
    <div class="press-content-aside col-md-4">
      <h3>
        @php _e("Museum Press","sage"); @endphp
      </h3>
      @include('partials.content-side-navigation')
      @include('partials.content-side-press-listing')
      
    </div>
    @if ($post->post_name !='press')
      @while(have_posts()) @php(the_post())
            <div class="press-content-main col-md-8"> 
              @if($press)
                @foreach ($press as $press_group)
                  @include('partials.content-press-listing')
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
    @else
      <div class="press-content-main col-md-8"> 
        <div class="coverage-listing">
          @if($coverage)
            <h3>@php _e("Recent Press Coverage","sage"); @endphp</h3>
            @foreach ($coverage as $press_item)
             @include('partials.content-press-card',['item_id'=>$press_item->ID])
            @endforeach
          @endif
        </div>
        <div class="releases-listing">
          @if($releases)
            <h3>@php _e("Museum Press Releases","sage"); @endphp</h3>
            @foreach ($releases as $press_item)
              @include('partials.content-press-card',['item_id'=>$press_item->ID])
            @endforeach
          @endif
        </div>

      </div>
       
    @endif
  </div>
@endsection
