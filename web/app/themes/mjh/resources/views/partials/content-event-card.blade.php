{{-- You must pass the post ID to this template as $item_id --}}
<div class="event-card slide-card">
  <!-- Hero bg in header template -->
  <a href="{!! get_the_permalink($item_id); !!}" class="card-link">
    <div class="card-image" style="background-image:url({{App::featuredImageSrc('square@1x',$item_id)}})">
      <span class="sr-only">TODO: Add Alt text</span>
      <span class="card-category">{!! App::postTermsString($item_id,'event_category') !!}</span>
    </div>
    <div class="info">
      <h3>{{ get_the_title($item_id) }}</h3>
      <!--<p class="description">{{App::postExcerpt($item_id)}}</p>-->
    </div>
    <div class="details">
      @if (App::get_repeater_field('event_dates',$item_id))
      <div class="event-dates">
        <ul>
          @foreach (App::get_repeater_field('event_dates',$item_id) as $event_date)
	          <li>{{ $event_date['event_start_date'] }} <!--@if ($event_date['event_end_date']) &#8211; {{ $event_date['event_end_date']
	            }}@endif-->
	          </li>
	          @break
          @endforeach
        </ul>
      </div>
      @endif
    </div>
  </a>
</div>