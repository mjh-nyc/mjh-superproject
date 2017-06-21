@if (App::getStickyPosts() && has_category( 'press' ))
  <h3>@php _e("Museum Press  ","sage"); @endphp</h3>
	<div class="side press-list">
		<ul>
			@foreach (App::getStickyPosts() as $post_id )
			  @if(has_category( 'press', $post_id ))
				<li @if ($post_id === get_the_ID()) class="current" @endif><a href="{{ the_permalink($post_id ) }}">{!! get_the_title($post_id) !!}</a></li>
				@endif
			@endforeach
		</ul>
	</div>
@endif
