@php $coreSubPageNav = App::hasCoreSubPageNav() @endphp
@if ($coreSubPageNav)
	<div class="subPageNav">
		<ul id="menu-collapsible-sidenavigation" class="menu">
			<!-- print top level page -->
			@for ($i = 0; $i < count($coreSubPageNav); $i++)
				<li class="menu-item menu-item-has-children @if($coreSubPageNav[$i] == App::get_parent_id(get_the_ID())) current-menu-parent @endif"><a href="#" class="parent"><span> {{ App::postTitle(App::get_parent_id($coreSubPageNav[$i])) }}</span></a>
					<ul class="sub-menu">
						<!-- subpages -->
						@foreach (App::getSubPageNav($coreSubPageNav[$i]) as $page)
							<li><a href="{{ the_permalink($page->ID) }}" @if ($page->ID === get_the_ID()) class="current" @endif>{!! $page->post_title !!}</a></li>
						@endforeach
					</ul>
				</li>
			@endfor
		</ul>
	</div>
@endif
