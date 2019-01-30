{{-- You must pass the post ID to this template as $item_id --}}
<div class="slide-card exhibtion-card" @if ($header) data-header="{{ $header }}" @endif>
	<!-- Hero bg in header template -->
	<a href="{!! get_the_permalink($item_id); !!}" class="card-link">
	<div class="card-image" style="background-image: url('{{App::featuredImageSrc('square@1x',$item_id)}}')">
		<span class="sr-only">{{ App::featuredImageAlt($item_id) }}</span>
	</div>
	<h3 class="card-title">{{ App::truncateString(get_the_title($item_id), 8) }}</h3>
	<p class="description">{{ App::postExcerpt($item_id) }}</p>
	@if(App::getCoreExhibitionID() != get_the_ID())
		<div class="details">
			<h4>{{App::get_field('exhibition_type',$item_id)}}</h4>
			<p>
			@if (App::get_field('exhibition_start_date',$item_id))
				{{App::get_field('exhibition_start_date',$item_id)}} &#8211; {{App::get_field('exhibition_end_date',$item_id)}}
			@elseif (get_post_type($item_id) == "event")
	            @if (App::get_field('event_end_date',$item_id))
	              {{ App::cleanDateOutput(App::get_field('event_start_date',$item_id),App::get_field('event_end_date',$item_id)) }}
	            @else
	              {{ App::get_field('event_start_date',$item_id) }} 
	            @endif
			@endif
			</p>
		</div>
	@endif
	</a>
</div>