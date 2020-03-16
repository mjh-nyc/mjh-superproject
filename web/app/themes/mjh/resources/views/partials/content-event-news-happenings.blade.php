<div class="container event-news-happenings">
  <div class="header">
    @php _e("Virtual Museum Experiences","sage"); @endphp
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
  <div class="post listing homepage row">
    @if ($press_posts)
      <div class="col-md-6 wrapper">
        <div class="see-all"><a href="/press/">{!! _e("See all &#8594;","sage") !!}</a></div>
        <div class="press slider-posts mjh-slider">
        @foreach ($press_posts as $press_post)
          @include('partials.content-blog-press-slideshow', ['item_id'=>$press_post->ID,'post_type_title'=>__("From the press room","sage")])
        @endforeach
      </div>
    </div>
    @endif
    @if ($blog_posts)
      <div class="col-md-6 wrapper">
        <div class="see-all"><a href="/blog/">{!! _e("See all &#8594;","sage") !!}</a></div>
        <div class="blog slider-posts mjh-slider">
        @foreach ($blog_posts as $blog_post)
          @include('partials.content-blog-press-slideshow', ['item_id'=>$blog_post->ID,'post_type_title'=>__("From the blog","sage")])
        @endforeach
        </div>
      </div>
    @endif
  </div>
</div>
