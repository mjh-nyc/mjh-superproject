@if (App::relatedLinks())
	<div class="related-links">
		<div class="subhead">@php _e("Related Links","sage"); @endphp</div>
		<ul>
			@foreach (App::relatedLinks() as $related_link)
				<li><a href="{{ $related_link['related_link_url'] }}" @if ($related_link['related_link_target']) target="_blank" @endif>{{ $related_link['related_link_title'] }}</a></li>
			@endforeach
		</ul>
	</div> 
@endif