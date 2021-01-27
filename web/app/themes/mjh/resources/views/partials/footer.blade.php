<footer class="content-info container-fluid">
  <div class="container">
    <h3>
      {{App::siteName()}}
    </h3>

    <div class="row">
      @php(dynamic_sidebar('sidebar-footer'))
    </div>

    <div class="copyright row">
      <div class="col-md-12">
        @if (has_nav_menu('footer_navigation'))
          {!! wp_nav_menu(['theme_location' => 'footer_navigation', 'container_class' => 'links']) !!}
        @endif
        <div class="content">
          <p>&copy; @php echo date("Y"); @endphp {{App::siteName()}}. @php _e("All Rights Reserved.","sage"); @endphp</p>
        </div>
      </div>
    </div>
  </div>
  <!--exit prompt-->
  <div id="exit-prompt" class="exit-message lity-hide">
    <div class="container">
      {!! App::get_field('site_exit_prompt','options') !!}
      <a href="#" class="exit cta-round cta-primary"> {{ App::get_field('site_exit_proceed_button_text','options') }} </a> &nbsp; <a href="javascript:void(0);" data-lity-close>Cancel</a>
    </div>

  </div>
</footer>
<!--
Event snippet for MOJH Retargeting Pixel on https://mjhnyc.org/: Please do not remove.
-->
<noscript>
  <img src="https://ad.doubleclick.net/ddm/activity/src=9105301;type=retar0;cat=mojhr0;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;tfua=;npa=;ord=1?" width="1" height="1" alt=""/>
</noscript>
<!-- End of event snippet: Please do not remove -->
<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window,document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '904453223633161');
  fbq('track', 'PageView');
</script>
<noscript>
  <img height="1" width="1"
       src="https://www.facebook.com/tr?id=904453223633161&ev=PageView
&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->
