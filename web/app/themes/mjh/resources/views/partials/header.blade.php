<header class="banner">
  @if (App::getAnnouncement())
  <div class="announcement">
    <!--<div class="announcement-header">
      <i class="fa fa-exclamation-circle fa-lg" aria-hidden="true"></i> @php _e("Attention","sage"); @endphp
    </div>-->
    <div class="announcement-content">
      {!! App::getAnnouncement() !!}
    </div>
  </div>
  @else
  <div class="moto hidden-sm-down">
    {{ App::siteDescription() }}
  </div>
  @endif

  <div class="top-wrapper container">
    <div class="top-links row">
      <div class="social-channels col-sm-5">
        {!! App::get_social() !!}
      </div>
      <div class="nav-secondary col-sm-7">
       @if (has_nav_menu('minitop_navigation'))
        {!! wp_nav_menu(['theme_location' => 'minitop_navigation']) !!}
        @endif
      </div>
    </div>
    <div class="sticky">
      <div class="sticky-container">
        <div class="row justify-content-between">
          <div class="col-8 col-sm-4 ">
            {!!  get_custom_logo() !!}
          </div>
          <div class="col-4 col-sm-8 right align-items-center">
            <div class="overlay-toggle"><a href="" class="" id="primary-nav-toggle"><span class="sr-only"> @php _e("Navigation","sage"); @endphp</span></a></div>
            @if (has_nav_menu('buttontop_navigation'))
              {!! wp_nav_menu(['theme_location' => 'buttontop_navigation', 'menu_class' => 'actions']) !!}
            @endif
            
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <!-- featured image and page title area -->
  @if (!is_front_page())
    <div class="hero-area parallax-window" data-parallax="scroll" data-image-src="@if (App::isPageTemplate( 'views/template-exhibitions-listing.blade.php') ) {!! $highlighted_exhibition_featured_image !!} @else {{App::featuredImageSrc('large')}} @endif" data-over-scroll-fix="true" alt="{{App::featuredImageAlt(get_post_thumbnail_id())}}">
      <div class="sr-only">{{App::featuredImageAlt(get_post_thumbnail_id())}}</div>
      @include('partials.page-header')
      <!--<div class="image-credit">
        {{App::featuredImageDesc(get_post_thumbnail_id())}}
      </div>-->
    </div>
  @endif
</header>

<div class="overlay-nav container-fluid no-gutters" style="">
  <div class="container">
    <div class="overlay-toggle">
      <a href="#" id="primary-nav-close"><span class="sr-only"> @php _e("Close Navigation","sage"); @endphp</span></a>
    </div>
    <div class="row">
      <div class="wrapper">
        <div class="site-search">
          {!! get_search_form(false) !!}
        </div>
        <nav class="nav-primary">
          @if (has_nav_menu('primary_navigation'))
            {!! wp_nav_menu(['theme_location' => 'primary_navigation']) !!}
          @endif
        </nav>
        @if (has_nav_menu('minitop_navigation'))
          {!! wp_nav_menu(['theme_location' => 'minitop_navigation']) !!}
        @endif
        <div class="social-channels">
          {!! App::get_social() !!}
        </div>
      </div>
    </div>
  </div>
</div>
