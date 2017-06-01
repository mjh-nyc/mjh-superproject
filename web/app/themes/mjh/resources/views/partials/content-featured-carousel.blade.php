@if (Homepage::carouselItems())
<div class="onview">
	<div class="header"><h1>Now on view</h1></div>
	<div class="featured-carousel slider-nav container">
		@foreach (Homepage::carouselItems() as $carousel_item_id)
      		@include('partials.content-exhibition-card')
    	@endforeach
	</div>
</div>
@endif
