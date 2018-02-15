<!--<div class="press-content-aside col-md-4">-->

	<div class="side press-list">
		<!--<ul>
			@foreach (App::getPressStickyPosts() as $post_id )
				@if(has_category( 'press', $post_id ))
					<li @if ($post_id === get_the_ID()) class="current" @endif><a href="{{ the_permalink($post_id ) }}">{!! get_the_title($post_id) !!}</a></li>
				@endif
			@endforeach
		</ul>-->

		<ul>
			@if (empty(App::get_repeater_field('related_link_repeater')))
				@php $item_id = wp_get_post_parent_id( $post->ID ) @endphp
			@else
				@php $item_id = $post->ID @endphp
			@endif

			@foreach (App::get_repeater_field('related_link_repeater',$item_id) as $related_link)
				<li><a href="{{ $related_link['related_link_url'] }}" @if ($related_link['related_link_target']) target="_blank" @endif>{{ $related_link['related_link_title'] }}</a></li>
			@endforeach
		</ul>

	</div>
	<div class="side desc">
		@while(have_posts()) @php(the_post())
			@php
			$content_post = get_post($item_id);
			$content = $content_post->post_content;
			$content = apply_filters('the_content', $content);
			$content = str_replace(']]>', ']]&gt;', $content);
			echo $content;
			@endphp
		@endwhile
	</div>
<!-- </div>-->

