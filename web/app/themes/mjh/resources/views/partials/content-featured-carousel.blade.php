@if (have_rows('featured_carousel_repeater') )
<div class="onview">
	<div class="header"><h1>Now on view</h1></div>
	<div class="featured-carousel container">
	  @while(have_rows('featured_carousel_repeater')) @php(the_row())
      		<div class="slide">
						<div><a href=""><img src=""></a></div>
						<h3>@php
        		  $post_obj = get_sub_field('carousel_item');
        		  echo($post_obj->post_title);
        		@endphp</h3>
						<p class="description">Post excerpt post excerpt post excerpt</p>
						<div class="details">
							<h4>On View</h4>
							<p>January 18 - July 23, 2017</p>
						</div>
      		</div>
    	@endwhile
	</div>
</div>
@endif
