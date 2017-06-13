@if (App::getSubPageNav())
	<div class="subPageNav">
		<ul>
			<!-- print top level page -->
			<li @if (App::is_ancestor(get_the_ID())) class="current" @endif><a href="{{ get_the_permalink(App::get_parent_id(get_the_ID())) }}">{{ App::postTitle(App::get_parent_id(get_the_ID())) }}</a></li>
			<!-- subpages -->
			@foreach (App::getSubPageNav() as $page)
				<li @if ($page->ID === get_the_ID()) class="current" @endif><a href="{{ the_permalink($page->ID) }}">{!! $page->post_title !!}</a></li>
			@endforeach
		</ul>
	</div>
@endif
