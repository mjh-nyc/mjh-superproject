{{--
  Template Name: Press Listing
--}}

@extends('layouts.app')
@section('content')
  <div class="row">
    @include('partials.content-side-press-listing')
    @while(have_posts()) @php(the_post())
          <div class="press-content-main col-md-8"> 
            @if($press)
              <div class="press listing-header">
                <h3>
                  @if (! empty($_GET["type"]))
                    @if ($_GET["type"] == "coverage")
                      @php _e("All Recent Press Coverage","sage"); @endphp
                    @elseif ($_GET["type"] == "pr")
                      @php _e("All Museum Press Releases","sage"); @endphp
                    @else 
                      @php _e("All Press Coverage","sage"); @endphp
                    @endif
                  @else
                    @php _e("All Press Coverage","sage"); @endphp
                  @endif
                </h3>
              </div>
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
