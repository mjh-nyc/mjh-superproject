{{-- You must pass the post ID to this template as $item_id --}}
<div class="slide-card exhibtion-card" @if ($header) data-header="{{ $header }}" @endif>
	<!-- Hero bg in header template -->
	<a href="{!! get_the_permalink($item_id); !!}" class="card-link">
	
	<div class="card-image @if(!is_front_page()){{_('lazy')}}@endif" @if(!is_front_page()) data-src="{{App::featuredImageSrc('square@1x',$item_id)}}|{{App::featuredImageSrc('square@2x',$item_id)}}" @endif>
		@if(is_front_page())
			<img src="@asset('images/placeholder.png')" data-lazy="{{App::featuredImageSrc('square@2x',$item_id)}}" data-mobilesrc="{{App::featuredImageSrc('square@1x',$item_id)}}">
			<span class="sr-only">{{ App::featuredImageAlt($item_id) }}</span>
		@endif
	</div>
	<h3 class="card-title">{!! get_the_title($item_id) !!}</h3>
	@if(has_excerpt($item_id))
		<p class="description">{!! get_the_excerpt($item_id) !!}</p>
	@endif
	@if(get_post_type($item_id) == "exhibition") {{-- && App::getCoreExhibitionID() != get_the_ID() --}}
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