{{-- You must pass the post ID to this template as $item_id --}}
<div class="home-post slide">
    <span class="card-category">{{$post_type_title}}</span>
    <div class="info">
      <h2><a href="{!! get_the_permalink($item_id); !!}">{{ App::truncateString(get_the_title($item_id),8) }}</a></h2>
    </div>
</div>
