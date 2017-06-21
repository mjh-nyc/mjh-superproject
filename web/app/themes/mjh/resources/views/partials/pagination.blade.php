<nav class="navigation pagination" role="navigation">
	<h2 class="screen-reader-text">@php _e("Posts navigation","sage"); @endphp</h2>
	<div class="nav-links">
	{!! App::paginate_links($max_num_pages) !!}
	</div>
</nav>
