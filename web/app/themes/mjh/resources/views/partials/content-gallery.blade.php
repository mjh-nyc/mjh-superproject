@if (App::get_field('image_slideshow'))
	<div class="mjh-slider mjh-gallery">
		@foreach( App::get_field('image_slideshow') as $image )
            <div class="slide">
            	<div class="slide-image" style="background-image: url('{{ $image['sizes']['medium'] }}');">
               		<span class="sr-only">{{ $image['alt'] }}"</span>
               	</div>
               	<div class="slide-caption">
            		{{ $image['caption'] }}
            	</div>
            </div>

        @endforeach
    </div>
@endif