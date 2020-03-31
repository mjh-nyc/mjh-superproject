<div class="container event-news-happenings"> 
  <div class="header">
    {{App::get_field('featured_events_header')}}
  </div>
  <div class="events listing hompage row">
    @if ($upcoming_events)
      @foreach ($upcoming_events as $event)
      <article @php(post_class())>
        @include('partials.content-event-card', ['item_id'=>$event->ID])
      </article>
      @endforeach
    @endif
    <div class="w-100"></div>
    <div class="see-all">
      <a href="/current-events/" class="cta-round cta-outline cta-secondary">@php _e("See all events","sage"); @endphp</a>
    </div>
  </div>
  
</div>