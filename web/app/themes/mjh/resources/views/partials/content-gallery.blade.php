@if (App::get_field('image_slideshow'))
	<div class="gallery">
		@foreach( App::get_field('image_slideshow') as $image )
            <div class="slide" style="background-image: url('{{ $image['sizes']['medium'] }}'); height:350px;">
               <span class="sr-only">{{ $image['alt'] }}"</span>
            </div>
        @endforeach
    </div>
@endif