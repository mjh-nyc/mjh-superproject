<div class="wrap museum-plan container-fluid no-gutters">
  @include('partials.content-museum-plan')
</div>
@if(!empty(App::get_field('announcements_homepage', 'option')))
  <div class="wrap special-announcement container-fluid">
    @include('partials.content-special-announcement')
  </div>
@endif
<div class="wrap recommended-by container-fluid">
  @include('partials.content-recommended-by')
</div>

