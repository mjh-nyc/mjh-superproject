<article @php(post_class())>
  <div class="entry-content">
    @include('partials.content-share')
    <div class="author">
      {{ __('By', 'sage') }} <a href="{{ get_author_posts_url(get_the_author_meta('ID')) }}" rel="author" class="fn">{{ get_the_author() }}</a>
    </div>
    @php(the_content())
     @include('partials.content-gallery')
    <nav class="page-nav">
      @php(previous_post_link('<div class="nav-previous"><span class="nav-direction">Previous</span></br><strong>%link<strong>'))
      @php(next_post_link('<div class="nav-next"><span class="nav-direction">Next</span></br><strong>%link<strong>'))
    </nav>
    @include('partials.content-related-links')
  </div>
</article>
