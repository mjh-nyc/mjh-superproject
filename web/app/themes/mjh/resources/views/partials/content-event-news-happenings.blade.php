<div class="container event-news-happenings">
  <div class="header">
    <h1>@php _e("Events, News &amp; Happenings","sage"); @endphp</h1>
    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam dui orci, sollicitudin eu massa vel, fermentum laoreet
      tellus. Etiam eu egestas felis, sit amet rhoncus dui.</div>
  </div>
  <div class="events listing hompage row">
    @foreach ($upcoming_events as $event)
    <article @php(post_class())>
      @include('partials.content-event-card', ['item_id'=>$event->ID])
    </article>
    @endforeach
  </div>
  <div class="post listing homepage">
    <div class="blog">
    </div>

    <div class="press">
    </div>
  </div>
</div>