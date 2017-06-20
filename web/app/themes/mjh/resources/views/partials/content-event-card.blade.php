{{-- You must pass the post ID to this template as $item_id --}}
<div class="event-card slide-card">
  <!-- Hero bg in header template -->
  <a href="{!! get_the_permalink($item_id); !!}" class="card-link">
    <div class="card-image" style="background-image:url({{App::featuredImageSrc('square@1x',$item_id)}})">
      <span class="sr-only">{{ App::featuredImageAlt($item_id) }}</span>
      <span class="card-category">{!! App::postTermsString($item_id,'event_category') !!}</span>
    </div>
    <div class="info">
      <h3>{{ get_the_title($item_id) }}</h3>
      <!--<p class="description">{{App::postExcerpt($item_id)}}</p>-->
    </div>
    <div class="details">
      @if (App::get_field('event_start_date',$item_id))
      <div class="event-dates">
          	@if (App::get_field('event_end_date',$item_id))
          		{{ App::cleanDateOutput(App::get_field('event_start_date',$item_id),App::get_field('event_end_date',$item_id)) }}
          	@else
          		{{ App::get_field('event_start_date',$item_id) }} 
          	@endif
          	@if (App::get_field('one_off_bool',$item_id))
          		/ {{ App::get_field('event_start_time',$item_id) }}
	        @endif
      </div>
      @endif
    </div>
  </a>
</div>