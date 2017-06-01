<div class="slide exhibtion-card">
	<!-- Hero bg in header template -->
	<div class="featured-image"><div class="wrap">
		<a href="{!! get_the_permalink($carousel_item_id['carousel_item']); !!}">{!! App::featuredImage('square@1x',$carousel_item_id['carousel_item']) !!}</a>
	</div></div>
	<h3>{{App::postTitle($carousel_item_id['carousel_item'])}}</h3>
	<p class="description">{{App::postExcerpt($carousel_item_id['carousel_item'])}}</p>
	<div class="details">
		<h4>{{App::get_field('exhibition_type',$carousel_item_id['carousel_item'])}}</h4>
		@if (App::get_field('exhibition_start_date',$carousel_item_id['carousel_item']))
			<p>{{App::get_field('exhibition_start_date',$carousel_item_id['carousel_item'])}} &#8211; {{App::get_field('exhibition_end_date',$carousel_item_id['carousel_item'])}}</p>
		@endif
	</div>
</div>