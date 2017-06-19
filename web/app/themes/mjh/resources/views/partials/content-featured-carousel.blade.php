@if (App::get_repeater_field('featured_carousel_repeater'))
<div class="hero-area-home">   
	<div class="slider-for">
		@foreach (App::get_repeater_field('featured_carousel_repeater') as $item)
			<div class="slide-card" style="background-image:url('{{App::get_field('hero_image',$item['carousel_item'])['sizes']['large']}}');"><span class="sr-only">{{App::get_field('hero_image',$item['carousel_item'])['alt']}}</span></div>
		@endforeach
	</div>
</div>
<div class="onview">
		<div class="header"><h1>@php _e("Now on view","sage"); @endphp</h1></div>
		<div class="featured-carousel  mjh-slider slider-nav container">
				@foreach (App::get_repeater_field('featured_carousel_repeater') as $item)						
						@include('partials.content-exhibition-card',['item_id' => $item['carousel_item'],'header' => $item['carousel_item_header']])
				@endforeach
		</div>
</div>
@endif
