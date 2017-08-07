<div class="press-content-aside col-md-4">
	<h3>
		@php _e("Museum Press","sage"); @endphp
	</h3>
	<div class="side press-list">
		<ul>
			@foreach (App::getPressStickyPosts() as $post_id )
				@if(has_category( 'press', $post_id ))
					<li @if ($post_id === get_the_ID()) class="current" @endif><a href="{{ the_permalink($post_id ) }}">{!! get_the_title($post_id) !!}</a></li>
				@endif
			@endforeach
		</ul>
	</div>
</div>

