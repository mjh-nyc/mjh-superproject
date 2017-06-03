{{-- You must pass the post ID to this template as $item_id --}}
<div class="event-card">
	<!-- Hero bg in header template -->
	<div class="card-image"><div class="wrap">
		<span><a href="{!! get_the_permalink($item_id); !!}">{!! App::featuredImage('square@1x',$item_id) !!}</a></span>
	</div>
	<span class="card-category">{!! App::postTermsString($item_id,'event_category') !!}</span>
	</div>
	<h3>{{ get_the_title($item_id) }}</h3>
	<p class="description">{{App::postExcerpt($item_id)}}</p>
	<div class="details">
    @if (App::get_repeater_field('event_dates',$item_id))
    <div class="event-dates">
      <ul>
        @foreach (App::get_repeater_field('event_dates',$item_id) as $event_date)
          <li>{{ $event_date['event_start_date'] }} @if ($event_date['event_end_date']) &#8211; {{ $event_date['event_end_date'] }}@endif
          </li>
        @endforeach
      </ul>
    </div>
    @endif
	</div>
</div>
