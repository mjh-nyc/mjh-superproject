{{--
  Template Name: Blog Listing
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
      @if($blogs)
      <div class="rss-link">
        <a href="{!! get_site_url(); !!}/feed" class="cta-round cta-secondary">@php _e("RSS feed","sage"); @endphp</a>
      </div>
      <div class="listing-wrapper row">
        @foreach ($blogs as $blog_post)
          <article @php(post_class())>
            @include('partials.content-blog-card', ['item_id'=>$blog_post->ID])
          </article>
        @endforeach
      @else
        <div style="margin-bottom: 100px;">
          <div class="alert alert-warning">@php _e("There are no blog entries to display","sage"); @endphp</div>
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
