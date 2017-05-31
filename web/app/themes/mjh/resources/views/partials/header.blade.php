<header class="banner">
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
    <a class="brand" href="{{ home_url('/') }}">{!!  get_custom_logo() !!}</a>
    <div class="overlay-toggle">
      <a href="" class="" id="primary-nav-toggle"><i class="fa fa-bars" aria-hidden="true"></i></a>
    </div>
    @if (has_nav_menu('buttontop_navigation'))
      {!! wp_nav_menu(['theme_location' => 'buttontop_navigation', 'menu_class' => 'actions']) !!}
    @endif
  </div>

  <!-- featured image and page title area -->
  @if (!is_front_page())
    <div class="hero-area parallax-window" style="background-image:url('{{App::featuredImageSrc('large')}}')" data-parallax="scroll" data-image-src="{{App::featuredImageSrc('large')}}">
      @include('partials.page-header')
    </div>
  @else
    <div class="hero-area-home">   
      <div class="featured-carousel slider-for">
        @foreach (Homepage::carouselItems() as $carousel_item_id)
              <div class="slide" style="background-image:url('{{App::get_field('hero_image',$carousel_item_id['carousel_item'])['sizes']['large']}}');">
              </div>
          @endforeach
      </div>
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