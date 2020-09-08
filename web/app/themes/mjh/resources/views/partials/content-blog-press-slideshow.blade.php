{{-- You must pass the post ID to this template as $item_id --}}
<a href="{!! get_the_permalink($item_id); !!}" aria-label="{{ _e('Read the full blog post titled: ','sage') }} {{ get_the_title($item_id) }}">
	<div class="home-post slide">
		<img src="@asset('images/placeholder.png')" data-lazy="{{ App::featuredImageSrc('medium',$item_id) }}" data-mobilesrc="{{ App::featuredImageSrc('square@1x',$item_id) }}">

		<span class="sr-only">{{ App::featuredImageAlt($item_id) }}</span>
	    <div class="info">
	      <h2 class="card-title">{{ get_the_title($item_id) }}</h2>
	      {{--<p>{!! get_the_excerpt($item_id) !!}</p>--}}
	    </div>
	</div>
</a>
