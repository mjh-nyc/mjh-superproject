{{-- You must pass the post ID to this template as $item_id --}}
<div class="home-post slide">
    <span class="card-category">{{$post_type_title}}</span>
    <div class="info">
      <h2 class="card-title"><a href="{!! get_the_permalink($item_id); !!}">{{ get_the_title($item_id) }}</a></h2>
      <p>{{ get_the_excerpt($item_id) }}</p>
    </div>
</div>
