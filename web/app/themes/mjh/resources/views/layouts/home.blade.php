<!doctype html>
<html @php(language_attributes())>
  @include('partials.head')
  <body @php(body_class())>
    <div class="animsition">
      @php(do_action('get_header'))
      @include('partials.header')
      <div class="wrap carousel container-fluid" role="document">
            @yield('carousel')
      </div>
      <div class="wrap museum-plan container-fluid" role="document">
            @yield('museum-plan')
      </div>
      @if(!empty(App::get_field('announcements_homepage', 'option')))
        <div class="wrap special-announcement container-fluid" role="document">
              @yield('special-announcement')
        </div>
      @endif
      <div class="wrap recommended-by container-fluid" role="document">
        @yield('recommended-by')
      </div>
      <div class="wrap container" role="document">
        <div class="content">
          <main class="main">
            @yield('content')
          </main>
          @if (App\display_sidebar())
            <aside class="sidebar">
              @include('partials.sidebar')
            </aside>
          @endif
        </div>
      </div>
      @php(do_action('get_footer'))
      @include('partials.footer')
      @php(wp_footer())
    </div>
  </body>
</html>
