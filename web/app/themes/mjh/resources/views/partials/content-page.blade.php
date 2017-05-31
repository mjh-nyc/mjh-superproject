@if (App::pageSubHeader())
	<div class="page-subheader">
		{{App::pageSubHeader()}}
	</div>
@endif

<div class="page-content">
	@php(the_content())
</div>

@if (App::relatedLinks())
	<div class="related-links">
		<div class="subhead">Related Links</div>
		<ul>
			@foreach (App::relatedLinks() as $related_link)
				<li><a href="{{ $related_link['related_link_url'] }}" @if ($related_link['related_link_target']) target="_blank" @endif>{{ $related_link['related_link_title'] }}</a></li>
			@endforeach
		</ul>
	</div> 
@endif

{!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}