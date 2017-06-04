{{--
  Template Name: Exhibitions Listing
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.content-page')
    @foreach ($exhibitions_current_listings as $exhibition)
      <article @php(post_class())>
        @include('partials.content-exhibition-card', ['item_id'=>$exhibition->ID])
      </article>
      @endforeach
  @endwhile
@endsection
