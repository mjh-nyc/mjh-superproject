@if (App::get_repeater_field('featured_carousel_repeater'))
<div class="hero-area-home">   
	<div class="slider-for">
		@foreach (App::get_repeater_field('featured_carousel_repeater') as $carousel_item_id)
			<div class="slide" style="background-image:url('{{App::get_field('hero_image',$carousel_item_id['carousel_item'])['sizes']['large']}}');"></div>
		@endforeach
	</div>
</div>
<div class="onview">
		<div class="header"><h1>@php _e("Now on view","sage"); @endphp</h1></div>
		<div class="featured-carousel slider-nav container">
				@foreach (App::get_repeater_field('featured_carousel_repeater') as $carousel_item_id)
						@include('partials.content-exhibition-card')
				@endforeach
		</div>
</div>
@endif
