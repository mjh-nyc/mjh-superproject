<!doctype html>
<html @php(language_attributes())>
  @include('partials.head')
  <body @php(body_class())>
    <div class="animsition" role="document">
      @php(do_action('get_header'))
      @include('partials.header')
      @if (App::get_field('highlight_a_specific_exhibition','option'))
        <div class="wrap video container-fluid">
              @yield('hero')
        </div>
      @else
        <div class="wrap carousel container-fluid no-feature">
            @yield('carousel')
        </div>
      @endif
      @yield('flexible_homepage_content_sections')
      @php(do_action('get_footer'))
      @include('partials.footer')
      @php(wp_footer())
    </div>
  </body>
</html>
