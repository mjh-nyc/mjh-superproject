{{-- You must pass the post ID to this template as $item_id --}}
<div class="publication-card slide-card">
  <a href="{!! get_the_permalink($item_id); !!}" class="card-link">
    <div class="card-image lazy" data-src="{{App::featuredImageSrc('square@1x',$item_id)}}">
      <span class="sr-only">{{ App::featuredImageAlt($item_id) }}</span>
      {{--<span class="card-category pub">{!! App::postTermsString($item_id,'publication_category') !!}</span>--}}
    </div>
    <div class="info">
      <h3 class="card-title">{{ App::truncateString(get_the_title($item_id), 20) }}</h3>
      <p class="description">{{App::postExcerpt($item_id)}}</p>
    </div>
  </a>
</div>