@if (have_rows('featured_carousel_repeater') )
	<div class="featured-carousel">
	  @while(have_rows('featured_carousel_repeater')) @php(the_row())
      		<div class="slide">
        		@php
        		  $post_obj = get_sub_field('carousel_item');
        		  echo($post_obj->post_title);
        		@endphp
      		</div>
    	@endwhile
	</div>
@endif
