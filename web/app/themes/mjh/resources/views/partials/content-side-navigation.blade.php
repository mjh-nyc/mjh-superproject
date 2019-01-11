@if (App::getSubPageNav())
	<div class="subPageNav">
		<ul>
			<!-- print top level page -->
			<li><a href="{{ get_the_permalink(App::get_parent_id(get_the_ID())) }}" @if (App::is_ancestor(get_the_ID())) class="current" @endif>{{ App::postTitle(App::get_parent_id(get_the_ID())) }}</a></li>
			<!-- subpages -->
			@foreach (App::getSubPageNav() as $page)
				<li><a href="{{ the_permalink($page->ID) }}" @if ($page->ID === get_the_ID()) class="current" @endif>{!! $page->post_title !!}</a></li>
			@endforeach
		</ul>
	</div>
@endif
