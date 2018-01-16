@if (App::get_repeater_field('related_events_repeater'))
	<div class="related-events">
		<div class="subhead">@php _e("Related Events","sage"); @endphp</div>
		<ul>
			@foreach (App::get_repeater_field('related_events_repeater') as $related_event)
				<li><a href="{!! get_permalink($related_event['event']); !!}" target="_blank">{{ $related_event['event']->post_title }}</a></li>
			@endforeach
		</ul>
	</div> 
@endif