<article @php(post_class())>
  <div class="entry-content">
    @include('partials.content-share')
    {{-- 
    <div class="author">
      {{ __('By', 'sage') }} <a href="{{ get_author_posts_url(get_the_author_meta('ID')) }}" rel="author" class="fn">{{ get_the_author() }}</a>
    </div>
    --}}
    <div class="post-body">
      @php(the_content())
    </div>
    @include('partials.content-gallery')
    @if(!App::hideNavByPostCategory(get_the_id(),'category'))
      <nav class="page-nav row no-gutters">
        @php(previous_post_link('
        <div class="nav-previous"><span class="nav-direction">Previous</span><br>%link</div>','%title',true)) @php(next_post_link('
        <div class="nav-next"><span class="nav-direction">Next</span><br>%link</div>','%title',true))
      </nav>
    @endif
    @include('partials.content-related-links')
  </div>
</article>
