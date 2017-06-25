{{-- You must pass the post ID to this template as $item_id --}}
<div class="blog-card slide-card">
  <a href="{!! get_the_permalink($item_id); !!}" class="card-link">
    <div class="card-image" style="background-image:url({{App::featuredImageSrc('square@2x',$item_id)}})">
      <span class="sr-only">{{ App::featuredImageAlt($item_id) }}</span>
    </div>
    <div class="info">
      <h3 class="card-title">{{ App::truncateString(get_the_title($item_id),20) }}</h3>
      <!--<p class="description">{{App::postExcerpt($item_id)}}</p>-->
    </div>
    <div class="details">
      <div class="post-date">
        @if (is_sticky($item_id))
          <i class="fa fa-bullseye" aria-hidden="true"></i> Pinned
        @else
          {{ get_the_date('l, F j, Y',$item_id) }}
        @endif
      </div>
      <!--
      <div class="post-author">
        @php _e("By","sage"); @endphp {{ get_the_author_meta( 'display_name', $item_id ) }}
      </div>
      -->
    </div>
  </a>
</div>
