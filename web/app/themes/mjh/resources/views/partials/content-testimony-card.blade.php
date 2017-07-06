{{-- You must pass the post ID to this template as $item_id --}}
<div class="testimony-card slide-card">
  <a href="{{ App::getTestimonyLink($item_id) }}" class="card-link" @if (App::get_field('testimony_platform',$item_id)!="other") data-lity @endif>
    <div class="card-image tint" style="background-image:url({{App::featuredTestimonailImageSrc('square@2x',$item_id)}})">
      <span class="sr-only">{{ App::featuredImageAlt($item_id) }}</span>
      <div class="play-btn"><img src="@asset('images/play-button.svg')" alt="Play"></div>
    </div>
    <div class="info">
      <h3 class="card-title">{{ App::truncateString(get_the_title($item_id),20) }}</h3>
      <!--<p class="description">{{App::postExcerpt($item_id)}}</p>-->
    </div>
    <div class="details">
      <div class="testimony-category">
        {!! App::getTestimonyCategory($item_id) !!}
        <div class="more">
          <i class="fa fa-ellipsis-v" aria-hidden="true" data-link="{!! get_the_permalink($item_id); !!}"></i>
        </div>
      </div>
      <!--
      <div class="post-author">
        @php _e("By","sage"); @endphp {{ get_the_author_meta( 'display_name', $item_id ) }}
      </div>
      -->
    </div>
  </a>
</div>
