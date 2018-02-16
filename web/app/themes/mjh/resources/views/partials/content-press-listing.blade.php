{{-- You must pass the post ID to this template as $item_id --}}
<div class="listing-wrapper">
	<div class="listing-group">
		<h3>{{$press_group['display_date']}}</h3>
		<ul class="press listing-items">
			@foreach ($press_group['posts'] as $press_post)
				<li class="listing-item">
					@if ( !empty(App::get_field('publication_logo', $press_post->ID )) )
						{!! wp_get_attachment_image( App::get_field('publication_logo', $press_post->ID ), 'medium' ) !!}
					@endif
					
					<a href="{!! app::getPermalink($press_post->ID) !!}" title="{{$press_post->post_title}}">{{$press_post->post_title}}</a></li>
			@endforeach
		</ul>
	</div>
</div>