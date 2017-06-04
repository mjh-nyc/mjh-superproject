{{--
  Template Name: Events Listing Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
      <div class"event-form">
        <form id="event-listing-form" name="event-listing-form" method='get'>
          <div>
            <label for="event-dates">@php _e("Display","sage"); @endphp</label>
            <select name="event-dates" id="event-dates">
              <option value="upcoming">@php _e("Upcoming","sage"); @endphp</option>
              <option value="past">@php _e("Past","sage"); @endphp</option>
            </select>
          </div>
          <div>
            <label for="event-category" >In</label>
            <select name="event-category" id="event-category">
              <option value="">@php _e("All categories","sage"); @endphp</option>
              @foreach (get_terms('event_category') as $event_category)
                <option value="{{$event_category->term_id}}">{{$event_category->name}}</option>
              @endforeach
            </select>
          </div>
        </form>
      </div>
      @foreach ($events as $event)
        <article @php(post_class())>
          @include('partials.content-event-card', ['item_id'=>$event->ID])
        </article>
      @endforeach
    @include('partials.content-page')
  @endwhile
@endsection
