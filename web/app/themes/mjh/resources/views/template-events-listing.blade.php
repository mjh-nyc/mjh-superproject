{{--
  Template Name: Events Listing
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
      @include('partials.content-page')
      <div class="event-form">
        <form id="event-listing-form" name="event-listing-form" method='get' action="{!! APP::getPermalink() !!}">
          <div class="wrap">
            <label for="event-dates">@php _e("Display","sage"); @endphp</label>
            <div class="styled-select slate">
            <select name="event-dates" id="event-dates" class="">
              <option value="upcoming" @if($event_dates_request ==='upcoming')selected="selected" @endif >@php _e("Upcoming","sage"); @endphp</option>
              {{--<option value="live" @if($event_dates_request ==='live')selected="selected" @endif >@php _e("All upcoming live events","sage"); @endphp</option>--}}
              {{--<option value="month" @if($event_dates_request ==='month')selected="selected" @endif >@php _e("Events this month","sage"); @endphp</option>--}}
              {{--<option value="next-month" @if($event_dates_request ==='next-month')selected="selected" @endif >@php _e("Events next month","sage"); @endphp</option>--}}
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
        <div style="margin-bottom: 100px;">
          <div class="alert alert-warning">@php _e("There are no events to display","sage"); @endphp</div>
          {!! get_search_form(false) !!}
        </div>
      @endif
      </div>
      @if ($get_max_num_pages)
        @include('partials.pagination',['max_num_pages'=>$get_max_num_pages])
      @endif
    
  @endwhile
@endsection
