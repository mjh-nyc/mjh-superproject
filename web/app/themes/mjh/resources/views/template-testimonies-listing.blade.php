{{--
  Template Name: Testimonies Listing
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
      @include('partials.content-page')
      @if($testimonies)
      <div class="listing-wrapper row">
        @foreach ($testimonies as $testimony)
          <article @php(post_class())>
            @include('partials.content-testimony-card', ['item_id'=>$testimony->ID])
          </article>
        @endforeach
      @else
        <div style="margin-bottom: 100px;">
          <div class="alert alert-warning">@php _e("There are no testimonies to display","sage"); @endphp</div>
          {!! get_search_form(false) !!}
        </div>
      @endif
      </div>
      @if ($get_max_num_pages)
        @include('partials.pagination',['max_num_pages'=>$get_max_num_pages])
      @endif
    
  @endwhile
@endsection
