@if (App::get_repeater_field('featured_carousel_repeater'))
<div class="hero-area-home">   
	<div class="slider-for">
		@foreach (App::get_repeater_field('featured_carousel_repeater') as $item)
			<div class="slide" style="background-image:url('{{App::get_field('hero_image',$item['carousel_item'])['sizes']['large']}}');"><span class="sr-only">{{App::get_field('hero_image',$item['carousel_item'])['alt']}}</span></div>
		@endforeach
	</div>
</div>
<div class="onview">
		<div class="header"><h1>@php _e("Now on view","sage"); @endphp</h1></div>
		<div class="featured-carousel slider-nav container">
				@foreach (App::get_repeater_field('featured_carousel_repeater') as $item)
						@php $item_id = $item['carousel_item'] @endphp
						@include('partials.content-exhibition-card')
				@endforeach
		</div>
</div>
@endif
