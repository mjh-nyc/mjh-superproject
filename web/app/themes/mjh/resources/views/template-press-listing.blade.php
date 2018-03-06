{{--
  Template Name: Press Listing
--}}

@extends('layouts.app')
@section('content')
  <div class="row">
    <div class="press-content-aside col-md-4">
      <h3>
        @if ($post->post_name !='press')
          <a href="/press">
        @endif
        @php _e("Press Home","sage"); @endphp
        @if ($post->post_name !='press')
          </a>
        @endif
      </h3>
      @include('partials.content-side-press-listing')   
    </div>
    @if ($post->post_name !='press')
      @while(have_posts()) @php(the_post())
            <div class="press-content-main col-md-8"> 
              @if($press)
                @foreach ($press as $press_group)
                  {{--@include('partials.content-press-listing')--}}
                  <h3>{{$press_group['display_date']}}</h3>
                  <div class="press-card-listing">
                    @foreach ($press_group['posts'] as $press_item)
                      @include('partials.content-press-card',['item_id'=>$press_item->ID])
                    @endforeach
                  </div>
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
        @if($coverage)
          <h3>@php _e("Recent Press Coverage","sage"); @endphp</h3>
          <div class="press-card-listing coverage-listing">
                
              @foreach ($coverage as $press_item)
               @include('partials.content-press-card',['item_id'=>$press_item->ID])
              @endforeach
            
          </div>
          <div class="see-all">
            <a href="/press/coverage/" class="cta-round cta-arrow cta-secondary">@php _e("See All Press Coverage","sage"); @endphp</a>
          </div>
        @endif

        @if($releases)
          <h3>@php _e("Museum Press Releases","sage"); @endphp</h3>
          <div class="press-card-listing releases-listing">
            @foreach ($releases as $press_item)
              @include('partials.content-press-card',['item_id'=>$press_item->ID])
            @endforeach
          </div>
          <div class="see-all">
            <a href="/press/releases/" class="cta-round cta-arrow cta-secondary">@php _e("See All Museum Press Releases","sage"); @endphp</a>
          </div>
        @endif
        
      </div>
       
    @endif
  </div>
@endsection
