@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    {{App::featuredImageSrc()}}
    @include('partials.page-header')
    @include('partials.content-page')
  @endwhile
@endsection
