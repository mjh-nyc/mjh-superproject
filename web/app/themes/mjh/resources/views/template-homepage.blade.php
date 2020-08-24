{{--
  Template Name: Homepage Template
--}}

@extends('layouts.home')

@section('hero')
  @while(have_posts()) @php(the_post())
    @include('partials.content-featured-hero')
  @endwhile
@endsection

@section('flexible_homepage_content_sections')
    @while (have_rows('flexible_homepage_content_sections')) @php(the_row())
      @if(get_row_layout()=='special_feature_section')
        @include('partials.content-homepage-special-feature')
      @endif
      @if(get_row_layout()=='events_section')
        @include('partials.content-event-news-happenings')
      @endif
      @if(get_row_layout()=='exhibitions_section')
          @include('partials.content-featured-carousel')
      @endif
      @if(get_row_layout()=='blog_section')
          @include('partials.content-homepage-blog-slider')
      @endif
      @if(get_row_layout()=='about_section')
        @include('partials.content-homepage-about')
      @endif
      @if(get_row_layout()=='custom_section')
        @include('partials.content-homepage-custom')
      @endif
      @if(get_row_layout()=='custom_carousel_section')
        @include('partials.content-homepage-custom-carousel')
      @endif
    @endwhile
@endsection
