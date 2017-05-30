<header class="banner">
  <div class="container">
    <div class="top-links">
      <div class="social-channels">
        <a href="https://www.facebook.com/MuseumofJewishHeritage" target="_blank" onclick="return trackOutboundLink('https://www.facebook.com/MuseumofJewishHeritage', true)">
          <i class="fa fa-facebook" aria-hidden="true"></i></a>
        <a href="https://twitter.com/mjhnews" target="_blank" onclick="return trackOutboundLink('https://twitter.com/mjhnews', true)">
          <i class="fa fa-twitter" aria-hidden="true"></i></a>
        <a href="https://www.instagram.com/museumjewishheritage/" target="_blank" onclick="return trackOutboundLink('https://www.instagram.com/museumjewishheritage/', true)">
          <i class="fa fa-instagram" aria-hidden="true"></i></a>
        <a href="https://www.youtube.com/MuseumJewishHeritage/" target="_blank" onclick="return trackOutboundLink('https://www.youtube.com/MuseumJewishHeritage/', true)">
          <i class="fa fa-youtube" aria-hidden="true"></i></a>
        <a href="" target="_bank" class="yf">
          <img src="../app/themes/mjh/dist/images/young-friends.svg">
          </a>
      </div>
      <nav class="nav-secondary">
       @if (has_nav_menu('minitop_navigation'))
        {!! wp_nav_menu(['theme_location' => 'minitop_navigation']) !!}
        @endif
        <!--<ul>
          <li><a href="">Blog</a></li>
          <li><a href="">Press</a></li>
          <li><a href="">JewishGen</a></li>
          <li><a href="">Space Rental</a></li>
          <li><a href="">Donate</a></li>
        </ul>-->
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
    <div class="hero-area" style="background-image:url('{{App::featuredImageSrc()}}')">
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
      </div>
    </div>
  </div>
</div>