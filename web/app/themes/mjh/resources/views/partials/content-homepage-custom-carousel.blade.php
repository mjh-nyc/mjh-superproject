<div class="wrap custom-slider container-fluid no-gutters">
  <div class="row">
    <div class="col-md-12" style="text-align: center;">
      <div class="header">{{get_sub_field('custom_carousel_section_title')}}</div>
    </div>
  </div>
  <div class="custom-carousel row">
    <div class="col-md-12 wrapper">
      @php  $carousel_items = get_sub_field('custom_carousel_section_repeater');
            $carousel_total = count($carousel_items);
      @endphp
      <div id="slider-custom-{{get_row_index()}}" class="slider-custom mjh-slider container" @if($carousel_total < 4) style="padding-bottom: 0" @endif>
        @if(!empty(get_sub_field('custom_carousel_section_repeater')))
          @while (have_rows('custom_carousel_section_repeater')) @php(the_row())
            @if(empty(get_sub_field('custom_carousel_section_is_custom_content')))
              @php($item_id = get_sub_field('custom_carousel_section_post')[0])
            @endif
            <div class="custom-card slide-card">
              <a href="@if(!empty($item_id)){!! get_the_permalink($item_id) !!}@else {{get_sub_field('custom_carousel_link')}} @endif" class="card-link">
                <div class="card-image">
                  <img src="@asset('images/placeholder.png')" data-lazy="@if(!empty($item_id)){{App::featuredImageSrc('square@2x',$item_id)}}@else {{get_sub_field('custom_carousel_section_content')['callout_image']['sizes']['square@2x'] }} @endif" data-mobilesrc="@if(!empty($item_id)){{App::featuredImageSrc('square@1x',$item_id)}}@else {{get_sub_field('custom_carousel_section_content')['callout_image']['sizes']['square@1x'] }} @endif">

                  <span class="sr-only">@if(!empty($item_id)){{ App::featuredImageAlt($item_id) }}@else {{get_sub_field('custom_carousel_section_content')['callout_image']['alt']}} @endif</span>
                </div>
                <div class="info">
                  <h3 class="card-title">@if(!empty($item_id)){{ App::truncateString(get_the_title($item_id),10) }}@else {{get_sub_field('custom_carousel_section_content')['callout_title']}} @endif</h3>
                </div>
                <div class="custom-card--details">
                  @if(!empty($item_id)){{App::postExcerpt($item_id)}}@else {!! App::truncateString(get_sub_field('custom_carousel_section_content')['callout_copy'], 10) !!} @endif
                </div>
              </a>
            </div>
            @php($item_id=0)
          @endwhile
        @endif
      </div>
    </div>
  </div>
</div>
