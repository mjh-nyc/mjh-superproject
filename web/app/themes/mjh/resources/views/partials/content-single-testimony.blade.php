
<article @php(post_class(App::addLayoutClasses()))>
  <div class="col-content row">
    <div class="col-12">

      <div class="entry-content">
        @include('partials.content-share')
        @php(the_content())
        <p class="description">{{ the_excerpt() }}</p>
        <div class="testimonial-video">
          {!! App::get_field('testimony_video_embed') !!}
        </div>
      </div>
    </div>


  </div>
  <footer>

  </footer>
</article>
