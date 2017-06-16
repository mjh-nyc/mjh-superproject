{{-- You must pass the post ID to this template as $item_id --}}
<div class="slide-card exhibtion-card">
	<!-- Hero bg in header template -->
	<a href="{!! get_the_permalink($item_id); !!}" class="card-link">
	<div class="card-image" style="background-image:url({{App::featuredImageSrc('square@1x',$item_id)}})">
		<span class="sr-only"></span>
	</div>
	<h3>{{ get_the_title($item_id) }}</h3>
	<p class="description">{{App::postExcerpt($item_id)}}</p>
	<div class="details">
		<h4>{{App::get_field('exhibition_type',$item_id)}}</h4>
		@if (App::get_field('exhibition_start_date',$item_id))
			<p>{{App::get_field('exhibition_start_date',$item_id)}} &#8211; {{App::get_field('exhibition_end_date',$item_id)}}</p>
		@endif
	</div>
	</a>
</div>