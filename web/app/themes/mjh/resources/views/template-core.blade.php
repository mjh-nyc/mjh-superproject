{{--
  Template Name: Core Exhibition Template
--}}
@extends('layouts.app')
@if(App::get_field('redirect_link'))
	@php 
	$loc = App::get_field('redirect_link');
	header('location:'.$loc);
	@endphp
@endif
@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.content-page-core')
  @endwhile
@endsection
