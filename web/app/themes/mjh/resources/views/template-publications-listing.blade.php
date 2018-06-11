{{--
  Template Name: Publications Listing
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
      {{--
      <div class="publication-form">
        <form id="publication-listing-form" name="publication-listing-form" method='get' action="{!! APP::getPermalink() !!}">
          <div class="wrap">
            <label for="publication-categories">@php _e("Display","sage"); @endphp</label>
            <div class="styled-select slate">
            <select name="publication-category" id="publication-category" class="">
            	<option value="0" data-slug="">@php _e("All categories","sage"); @endphp</option>
            	@php $categories = App::getTaxonomyTerms('publication_category') @endphp
            	@foreach ($categories as $category)
              		<option value="{{ $category->term_id }}" data-slug="{{ $category->slug }}" @if($publication_category_request === $category->term_id)selected="selected" @endif>{{ $category->name }}</option>
            	@endforeach
            </select>
            </div>
          </div>
        </form>
      </div> --}}

      @if($publications)
      <div class="listing-wrapper row" style="margin-top: 3rem;">
        @foreach ($publications as $publication)
          <article @php(post_class())>
            @include('partials.content-publication-card', ['item_id'=>$publication->ID])
          </article>
        @endforeach
      @else
        <div style="margin-bottom: 100px;">
          <div class="alert alert-warning">@php _e("There are no publications to display","sage"); @endphp</div>
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
