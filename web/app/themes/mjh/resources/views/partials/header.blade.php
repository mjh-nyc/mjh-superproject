<header class="banner">
  <div class="container">
    <div class="top-links">
      <div class="social-channels">
        <a href="https://www.facebook.com/MuseumofJewishHeritage" target="_blank" onclick="return trackOutboundLink('https://www.facebook.com/MuseumofJewishHeritage', true)">
          <i class="fa fa-facebook" aria-hidden="true"></i></a>
          &nbsp; &nbsp;
        <a href="https://twitter.com/mjhnews" target="_blank" onclick="return trackOutboundLink('https://twitter.com/mjhnews', true)">
          <i class="fa fa-twitter" aria-hidden="true"></i></a>
          &nbsp; &nbsp;
        <a href="https://www.instagram.com/museumjewishheritage/" target="_blank" onclick="return trackOutboundLink('https://www.instagram.com/museumjewishheritage/', true)">
          <i class="fa fa-instagram" aria-hidden="true"></i></a>
          &nbsp; &nbsp;
        <a href="https://www.youtube.com/MuseumJewishHeritage/" target="_blank" onclick="return trackOutboundLink('https://www.youtube.com/MuseumJewishHeritage/', true)">
          <i class="fa fa-youtube" aria-hidden="true"></i></a>
      </div>
      <nav class="nav-secondary">
        <ul>
          <li><a href="">Blog</a></li>
          <li><a href="">Press</a></li>
          <li><a href="">JewishGen</a></li>
          <li><a href="">Space Rental</a></li>
          <li><a href="">Donate</a></li>
        </ul>
      </nav>
    </div>
    <a class="brand" href="{{ home_url('/') }}">{!!  get_custom_logo() !!}</a>
    <div class="actions">
      <a href="" class="cta sqr">Join</a>
      <a href="" class="cta sqr">Buy Tickets</a>
      <a href="" class="toggle"><i class="fa fa-bars" aria-hidden="true"></i></a>
    </div>
    <nav class="nav-primary">
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
      @endif
    </nav>
  </div>
</header>
