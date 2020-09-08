@php ($section_title = get_sub_field('exhibitions_section_title'))
@if (!empty(get_sub_field('featured_carousel_repeater')))
  <div class="wrap carousel container-fluid">
    <div class="hero-area-home">
      <div class="slider-for">
        @while (have_rows('featured_carousel_repeater')) @php(the_row())
        @php($post_id = get_sub_field('carousel_item'))
        @if (get_post_type($post_id) == "exhibition")
          <div class="slide-card lazy" data-src="{{App::get_field('hero_image',$post_id)['sizes']['large']}}"><span class="sr-only">{{App::get_field('hero_image',$post_id)['alt']}}</span></div>
        @elseif (get_post_type($item['carousel_item']) == "event")
          <div class="slide-card lazy" data-src="{{ App::featuredImageSrc('large',$post_id) }}"><span class="sr-only">{{ App::featuredImageAlt($post_id) }}</span></div>
        @endif
        @endwhile
      </div>
    </div>
    <div class="onview">
        <div class="header">{!! $section_title !!}</div>
        <div class="featured-carousel  mjh-slider slider-nav container">
          @while (have_rows('featured_carousel_repeater')) @php(the_row())
            @include('partials.content-exhibition-card',['item_id' => get_sub_field('carousel_item'),'header' => get_sub_field('carousel_item_header')])
          @endwhile
        </div>
    </div>
  </div>
@endif
