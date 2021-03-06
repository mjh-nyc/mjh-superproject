<article @php(post_class())>
  <div class="entry-content">
    @include('partials.content-share')
    {{-- 
    <div class="author">
      {{ __('By', 'sage') }} <a href="{{ get_author_posts_url(get_the_author_meta('ID')) }}" rel="author" class="fn">{{ get_the_author() }}</a>
    </div>
    --}}

    

    <div class="post-body">
      {{-- @php(the_content()) --}}
      
      @php 
      $pdfFile = App::get_field('publication_pdf');
      echo do_shortcode('[flipbook pdf="'.$pdfFile.'" width="100%" height="100%" theme="light"]'); @endphp 
    </div>
    @include('partials.content-gallery')
    <nav class="page-nav row no-gutters">
      @php(previous_post_link('
      <div class="nav-previous"><span class="nav-direction">Previous</span><br>%link</div>','%title',true)) @php(next_post_link('
      <div class="nav-next"><span class="nav-direction">Next</span><br>%link</div>','%title',true))
    </nav>
    @include('partials.content-related-links')
  </div>
</article>
