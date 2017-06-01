<header class="banner">
  <div class="announcement" style="">
    <div class="announcement-header">
      <i class="fa fa-exclamation-circle fa-lg" aria-hidden="true"></i> Attention
    </div>
    <div class="announcement-content">
      Due to the sever weather, we will be closed for the day
    </div>
  </div>
  <div class="moto">
    {{ App::siteDescription() }}
  </div>
  <div class="container">
    <div class="top-links">
      <div class="social-channels">
        {!! App::get_social() !!}
      </div>
      <nav class="nav-secondary">
       @if (has_nav_menu('minitop_navigation'))
        {!! wp_nav_menu(['theme_location' => 'minitop_navigation']) !!}
        @endif
      </nav>
    </div>
    <div class="sticky">
      {!!  get_custom_logo() !!}
      <div class="overlay-toggle">
        <a href="" class="" id="primary-nav-toggle"><i class="fa fa-bars" aria-hidden="true"></i></a>
      </div>
      @if (has_nav_menu('buttontop_navigation'))
        {!! wp_nav_menu(['theme_location' => 'buttontop_navigation', 'menu_class' => 'actions']) !!}
      @endif
    </div>
  </div>

  <!-- featured image and page title area -->
  @if (!is_front_page())
    <div class="hero-area parallax-window" data-parallax="scroll" data-image-src="{{App::featuredImageSrc('large')}}" data-over-scroll-fix="true">
      @include('partials.page-header')
    </div>
  @endif
</header>

<div class="overlay-nav container-fluid no-gutters" style="">
  <div class="container">
    <div class="overlay-toggle">
      <a href="#" id="primary-nav-close"><i class="fa fa-times" aria-hidden="true"></i></a>
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