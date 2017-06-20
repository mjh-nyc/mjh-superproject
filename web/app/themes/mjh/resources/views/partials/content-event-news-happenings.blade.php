<div class="container event-news-happenings">
  <div class="header">
    <h1>@php _e("Events, News &amp; Happenings","sage"); @endphp</h1>
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
      <a href="/current-events/" class="cta-round cta-outline cta-secondary">@php _e("See All","sage"); @endphp</a>
    </div>
  </div>
  <div class="post listing homepage">
    <div class="blog">
    </div>

    <div class="press">
    </div>
  </div>
</div>
