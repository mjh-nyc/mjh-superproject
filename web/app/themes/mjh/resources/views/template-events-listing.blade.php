{{--
  Template Name: Events Listing Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
      <div class="event-form">
        <form id="event-listing-form" name="event-listing-form" method='get'>
          <div class="wrap">
            <label for="event-dates">@php _e("Display","sage"); @endphp</label>
            <div class="styled-select slate">
            <select name="event-dates" id="event-dates" class="">
              <option value="upcoming" @if($event_dates_request ==='upcoming')selected="selected" @endif >@php _e("Upcoming","sage"); @endphp</option>
              <option value="past" @if($event_dates_request ==='past')selected="selected" @endif >@php _e("Past","sage"); @endphp</option>
            </select>
            </div>
          </div>
          <div class="wrap">
            <label for="event-category" >In</label>
            <div class="styled-select slate">
            <select name="event-category" id="event-category">
              <option value="">@php _e("All categories","sage"); @endphp</option>
              @foreach (get_terms('event_category') as $event_category)
                <option value="{{$event_category->term_id}}" @if($event_category_request === $event_category->term_id)selected="selected" @endif>{{$event_category->name}}</option>
              @endforeach
            </select>
            </div>
          </div>
        </form>
      </div>
      @if($events)
      <div class="listing-wrapper row">
        @foreach ($events as $event)
          <article @php(post_class())>
            @include('partials.content-event-card', ['item_id'=>$event->ID])
          </article>
        @endforeach
      @else
        <h3>There are no events to display</h3>
      @endif
      </div>
    @include('partials.content-page')
  @endwhile
@endsection
