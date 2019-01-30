{{--
  Template Name: Core Exhibition Template
--}}
@extends('layouts.app')
@if(App::get_field('redirect_link'))
    <script type="text/javascript">
        window.location.replace( '{!! App::get_field('redirect_link') !!}');
    </script>
@endif
@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.content-page-core')
  @endwhile
@endsection
