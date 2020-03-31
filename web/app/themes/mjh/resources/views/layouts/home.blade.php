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
        <div class="wrap press-quotes container">
          @yield('press-quotes')
        </div>
      @else
        <div class="wrap carousel container-fluid no-feature">
            @yield('carousel')
        </div>
      @endif

      <div class="container">
        @yield('homepage-special-feature')
      </div>

      <div class="wrap container">
        <div class="content">
          <main class="main">
            @yield('content')
          </main>
        </div>
      </div>
      <div class="wrap museum-plan container-fluid">
            @yield('museum-plan')
      </div>
      @if(!empty(App::get_field('announcements_homepage', 'option')))
        <div class="wrap special-announcement container-fluid">
              @yield('special-announcement')
        </div>
      @endif
      <div class="wrap recommended-by container-fluid">
        @yield('recommended-by')
      </div>

      @if ($blog_posts && App::get_field('blog_feature'))
        <div class="wrap blog-slider container-fluid">
          @yield('homepage-blog-slider')
        </div>
      @endif

      @if (App::get_field('highlight_a_specific_exhibition','option'))
        <div class="wrap carousel container-fluid">
              @yield('carousel')
        </div>
      @endif
      @php(do_action('get_footer'))
      @include('partials.footer')
      @php(wp_footer())
    </div>
  </body>
</html>
