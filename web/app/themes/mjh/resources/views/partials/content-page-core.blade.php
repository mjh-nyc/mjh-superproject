@if (App::get_field('exhibition_admission_required', App::getCoreExhibitionID()))
	<div class="exhibition-info">
		<!--<h3 class="subhead">{{App::get_field('exhibition_type', App::getCoreExhibitionID())}}</h3>-->
		<!-- //TODO -->
		<h3 class="subhead">Timed tickets available</h3>
		@if (App::get_field('exhibition_start_date', App::getCoreExhibitionID()))
		  <p>{{App::get_field('exhibition_start_date', App::getCoreExhibitionID())}} &#8211; {{App::get_field('exhibition_end_date', App::getCoreExhibitionID())}}</p>
		@endif
		<div class="buy-tix">
			<a href="/tickets/" class="cta-round cta-secondary">@php _e("Buy Exhibition Tickets","sage"); @endphp</a>
		</div>
	</div>
@endif
<div class="page-with-sidenav">
	@include('partials.content-side-navigation-core')
	<div class="page-content">
		@if (App::pageSubHeader())
			<h2 class="page-subheader">
				{{App::pageSubHeader()}}
			</h2>
		@endif
		@include('partials.content-share')
		<h2>{!! App\title() !!}</h2>
		@php(the_content())
		@include('partials.content-gallery')
		@include('partials.content-related-links')
	</div>
</div>


{!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}