<footer class="content-info container-fluid">
  <div class="container">
    <h3>
      {{App::siteName()}}
    </h3>

    <div class="row">
      @php(dynamic_sidebar('sidebar-footer'))
    </div>

    <div class="copyright row">
      @if (has_nav_menu('footer_navigation'))
        {!! wp_nav_menu(['theme_location' => 'footer_navigation', 'container_class' => 'links']) !!}
      @endif
      <div class="content">
        <p>&copy; @php echo date("Y"); @endphp {{App::siteName()}}. @php _e("All Rights Reserved.","sage"); @endphp</p>
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
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-PBW35TT');</script>
<!-- End Google Tag Manager -->
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PBW35TT"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<!--
Event snippet for MOJH Retargeting Pixel on https://mjhnyc.org/: Please do not remove.
-->
<noscript>
  <img src="https://ad.doubleclick.net/ddm/activity/src=9105301;type=retar0;cat=mojhr0;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;tfua=;npa=;ord=1?" width="1" height="1" alt=""/>
</noscript>
<!-- End of event snippet: Please do not remove -->