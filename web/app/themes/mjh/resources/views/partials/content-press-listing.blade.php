{{-- You must pass the post ID to this template as $item_id --}}
<div class="listing-wrapper">
	<div class="listing-group">
		<h2>{{$press_group['display_date']}}</h2>
		<ul class="listing-items">
			@foreach ($press_group['posts'] as $press_post)
				<li class="listing-item"><a href="{!! app::getPermalink($press_post->ID) !!}" title="{{$press_post->post_title}}">{{$press_post->post_title}}</a></li>
			@endforeach
		</ul>
	</div>
</div>