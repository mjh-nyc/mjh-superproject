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
