{{--
  Template Name: Press Listing
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
      @if($press)
      <div class="listing-wrapper row">
        @foreach ($press as $press_group)
          <div class="listing-group">
            <h2>{{$press_group['display_date']}}</h2>
            <ul class="listing-items">
            @foreach ($press_group['posts'] as $press_post)
              <li class="listing-item"><a href="{!! app::getPermalink($press_post->ID) !!}" title="{{$press_post->post_title}}">{{$press_post->post_title}}</a></li>
            @endforeach
            </ul>
          </div>
        @endforeach
      @else
        <div style="margin-bottom: 100px;">
          <div class="alert alert-warning">@php _e("There are no press posts to display","sage"); @endphp</div>
          {!! get_search_form(false) !!}
        </div>
      @endif
      </div>
      @if ($get_max_num_pages)
        @include('partials.pagination',['max_num_pages'=>$get_max_num_pages])
      @endif
    @include('partials.content-page')
  @endwhile
@endsection
