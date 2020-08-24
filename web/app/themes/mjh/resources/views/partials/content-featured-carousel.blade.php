@if (App::get_repeater_field('featured_carousel_repeater'))
  <div class="wrap carousel container-fluid">
    <div class="hero-area-home">
      <div class="slider-for">
        @foreach (App::get_repeater_field('featured_carousel_repeater') as $item)
          @if (get_post_type($item['carousel_item']) == "exhibition")
            <div class="slide-card lazy" data-src="{{App::get_field('hero_image',$item['carousel_item'])['sizes']['large']}}"><span class="sr-only">{{App::get_field('hero_image',$item['carousel_item'])['alt']}}</span></div>
          @elseif (get_post_type($item['carousel_item']) == "event")
            <div class="slide-card lazy" data-src="{{ App::featuredImageSrc('large',$item['carousel_item']) }}"><span class="sr-only">{{ App::featuredImageAlt($item['carousel_item']) }}</span></div>
          @endif

        @endforeach
      </div>
    </div>
    <div class="onview">
        <div class="header">@php _e("Now on view","sage"); @endphp</div>
        <div class="featured-carousel  mjh-slider slider-nav container">
            @foreach (App::get_repeater_field('featured_carousel_repeater') as $item)
                @include('partials.content-exhibition-card',['item_id' => $item['carousel_item'],'header' => $item['carousel_item_header']])
            @endforeach
        </div>
    </div>
  </div>
@endif
