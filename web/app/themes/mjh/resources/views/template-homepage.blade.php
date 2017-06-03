{{--
  Template Name: Homepage Template
--}}

@extends('layouts.home')
@section('carousel')
  @while(have_posts()) @php(the_post())
    @include('partials.content-featured-carousel')
  @endwhile
@endsection
@section('museum-plan')
    @include('partials.content-museum-plan')
@endsection
@section('content')
  @include('partials.content-event-news-happenings')
  @while(have_posts()) @php(the_post())
    @include('partials.content-page')
  @endwhile
@endsection
