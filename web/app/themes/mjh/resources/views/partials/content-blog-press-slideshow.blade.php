{{-- You must pass the post ID to this template as $item_id --}}
<div class="home-post slide">
  <!-- Hero bg in header template -->
  <a href="{!! get_the_permalink($item_id); !!}" class="card-link">
    <span class="card-category">{{$post_type_title}}</span>
    <div class="info">
      <h3>{{ get_the_title($item_id) }}</h3>
    </div>
  </a>
</div>
