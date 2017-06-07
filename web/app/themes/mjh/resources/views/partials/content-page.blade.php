@if (App::pageSubHeader())
	<div class="page-subheader">
		{{App::pageSubHeader()}}
	</div>
@endif
@include('partials.content-side-navigation')
<div class="page-content">
	@php(the_content())
</div>
@include('partials.content-gallery')
@include('partials.content-related-links')

{!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}