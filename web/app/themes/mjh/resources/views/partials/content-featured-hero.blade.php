<div class="hero-area-home">
	@if (App::get_field('highlighted_exhibition_logo','option'))
        <div class="hero-header-wrapper">
	        <div class="hero-header">
		        <a href="{{ get_the_permalink(App::getCoreExhibitionID()) }}"><img src="{{ App::get_field('highlighted_exhibition_logo','option')['url'] }}" alt="App::get_field('highlighted_exhibition_logo','option')['alt']" class="page-header--logo"></a>
		        <a href="/visitor-information/purchase-tickets/" class="cta-round cta-secondary" style="margin: 25px 0;">{{ App::get_field('highlighted_exhibition_button_text','option') }}</a>
		    </div>
		</div>
    @endif

	@if ( App::get_repeater_field('primary_sponsors_repeater', App::getCoreExhibitionID()) || App::get_repeater_field('secondary_sponsor_header', App::getCoreExhibitionID()) )
	    <div class="content-sponsors inheader">

	      @if (App::get_repeater_field('primary_sponsors_repeater', App::getCoreExhibitionID()))
	        <!-- Primary sponsors -->
	        @include('partials.content-sponsors', ['sectionTitle' => App::get_field('primary_sponsor_header', App::getCoreExhibitionID()),'sectionClass'=>"exhibition",'sectionType'=>"primary",'exhibitID'=>App::getCoreExhibitionID()])
	      @endif

	      @if (App::get_repeater_field('secondary_sponsors_repeater', App::getCoreExhibitionID()))
	        <!-- Secondary sponsors -->
	        @include('partials.content-sponsors', ['sectionTitle' => App::get_field('secondary_sponsor_header', App::getCoreExhibitionID()),'sectionClass'=>"exhibition",'sectionType'=>"secondary", 'exhibitID'=>App::getCoreExhibitionID()])
	      @endif
	    </div>
	@endif

	@if (App::get_field('video_link','option'))
		<div class="full-video-link">
			<a href="{{ App::get_field('video_link','option') }}" class="cta-round cta-outline cta-arrow">@php _e("View Full Video","sage"); @endphp</a>
		</div>
	@endif

	<video autoplay muted loop id="herovideo">
		<!--<source src="@asset('videos/auschwitz-intro.mp4')" type="video/mp4">-->
		<source src="/app/themes/mjh/resources/assets/videos/auschwitz-intro.mp4')" type="video/mp4">
	</video>


</div>