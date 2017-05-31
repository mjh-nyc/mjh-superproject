<footer class="content-info container-fluid">
  <div class="container">
    @php(dynamic_sidebar('sidebar-footer'))

    <h4>
      {{App::siteName()}}
    </h4>

    <div class="row">
      <div class="box">
        <h5>Find Us</h5>
        <p>Edmond J. Safra Plaza<br>
        36 Battery Place<br>
        New York, NY 10280<br>
        (646) 437–4202</p>
      </div>

      <div class="box">
        <h5>Stay in Touch!</h5>
        <p>Sign up with your email to receive news, updates and exclusive event invitations from the Museum of Jewish Heritage.</p>
        <a href="" class="cta">Sign up</a>
      </div>

      <div class="box">
        <h5>Supporters</h5>
        <p>Suspendisse vehicula nisl quis enim sagittis, nec mollis purus lacinia. In fringilla vel orci eu sagittis.</p>
        <a href="" class="cta">Learn more</a>
      </div>
      <div class="box">
        
        <h5>Visit Our Resident Theater Company</h5>
      </div>

    </div>

    <div class="copyright row">
      @if (has_nav_menu('footer_navigation'))
        {!! wp_nav_menu(['theme_location' => 'footer_navigation', 'container_class' => 'links']) !!}
      @endif
      <div class="content">
        <p>&copy; 2017 Museum of Jewish Heritage—A Living Memorial to the Holocaust. All rights reserved. </p>
      </div>
    </div>
  </div>
</footer>
