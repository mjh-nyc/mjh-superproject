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
    {!! App::get_field('site_exit_prompt','options') !!} 
  </div>
</footer>
<script>
//Google Analytics Code
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-29738632-1', 'auto');
        ga('send', 'pageview');

        var trackOutboundLink = function(url, isExternal) {
            var params = {};
          if (!isExternal) {
              params.hitCallback = function () {
                  document.location = url;
              }
          }
          ga('send', 'event', 'outbound', 'click', url, params);
          return isExternal;
          }
</script>
<!-- End Google Analytics Code -->
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1335537099825695'); // Insert your pixel ID here.
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" alt="" style="display:none"
src="https://www.facebook.com/tr?id=1335537099825695&ev=PageView&noscript=1"
/></noscript>
<!-- DO NOT MODIFY -->
<!-- End Facebook Pixel Code -->
<!-- Yahoo Pixel Tag Code -->
<script type="application/javascript">(function(w,d,t,r,u){w[u]=w[u]||[];w[u].push({'projectId':'10000','properties':{'pixelId':'10040907'}});var s=d.createElement(t);s.src=r;s.async=true;s.onload=s.onreadystatechange=function(){var y,rs=this.readyState,c=w[u];if(rs&&rs!="complete"&&rs!="loaded"){return}try{y=YAHOO.ywa.I13N.fireBeacon;w[u]=[];w[u].push=function(p){y([p])};y(c)}catch(e){}};var scr=d.getElementsByTagName(t)[0],par=scr.parentNode;par.insertBefore(s,scr)})(window,document,"script","https://s.yimg.com/wi/ytc.js","dotq");</script>
<!-- End Yahoo Pixel Tag Code -->
<!-- Global site tag (gtag.js) - Google Marketing Platform -->
<script async src="https://www.googletagmanager.com/gtag/js?id=DC-9105301"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'DC-9105301');
</script>
<!-- End of global snippet: Please do not remove -->
<!--
Event snippet for MOJH Retargeting Pixel on https://mjhnyc.org/: Please do not remove.
-->
<script>
    gtag('event', 'conversion', {
        'allow_custom_scripts': true,
        'send_to': 'DC-9105301/retar0/mojhr0+standard'
    });
</script>
<noscript>
  <img src="https://ad.doubleclick.net/ddm/activity/src=9105301;type=retar0;cat=mojhr0;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;tfua=;npa=;ord=1?" width="1" height="1" alt=""/>
</noscript>
<!-- End of event snippet: Please do not remove -->