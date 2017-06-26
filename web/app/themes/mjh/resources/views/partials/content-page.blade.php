@include('partials.content-side-navigation')
<div class="page-content">
	@if (App::pageSubHeader())
		<h2 class="page-subheader">
			{{App::pageSubHeader()}}
		</h2>
	@endif
	@php(the_content())
	@include('partials.content-gallery')
	@include('partials.content-related-links')
</div>


{!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}