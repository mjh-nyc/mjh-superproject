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

@section('special-announcement')
  @include('partials.content-special-announcement')
@endsection

@section('recommended-by')
  @include('partials.content-recommended-by')
@endsection

@section('content')
  @include('partials.content-event-news-happenings')
  @while(have_posts()) @php(the_post())
    @include('partials.content-page')
  @endwhile
@endsection
