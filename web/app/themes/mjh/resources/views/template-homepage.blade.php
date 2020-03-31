{{--
  Template Name: Homepage Template
--}}

@extends('layouts.home')

@section('hero')
  @while(have_posts()) @php(the_post())
    @include('partials.content-featured-hero')
  @endwhile
@endsection

{{--@section('press-quotes')
  @while(have_posts()) @php(the_post())
     @include('partials.content-press-quotes',['press_quotes'=>App::get_repeater_field( 'press_quotes', App::getCoreExhibitionID() )])
  @endwhile
@endsection--}}

@section('homepage-special-feature')
  @include('partials.content-homepage-special-feature')
@endsection

@section('homepage-blog-slider')
  @include('partials.content-homepage-blog-slider')
@endsection

@section('content')
  @include('partials.content-event-news-happenings')
  {{--@while(have_posts()) @php(the_post())
    @include('partials.content-page')
  @endwhile--}}
@endsection

@section('museum-plan')
    @include('partials.content-museum-plan')
@endsection

@section('special-announcement')
  @include('partials.content-special-announcement')
@endsection

@section('recommended-by')
  @include('partials.content-recommended-by')
@endsection

@section('carousel')
  @while(have_posts()) @php(the_post())
    @include('partials.content-featured-carousel')
  @endwhile
@endsection
