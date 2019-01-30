<div class="hero-area-home">
	
    <div class="hero-header-wrapper">
        <div class="hero-header">
        	@if (App::get_field('highlighted_exhibition_logo',App::getCoreExhibitionID()))
	        	<a href="{{ get_the_permalink(App::getCoreExhibitionID()) }}"><img src="{{ App::get_field('highlighted_exhibition_logo',App::getCoreExhibitionID())['sizes']['medium'] }}" alt="{{App::get_field('highlighted_exhibition_logo',App::getCoreExhibitionID())['alt']}}" class="page-header--logo"></a>
	        @else
	        	<h1>{!! get_the_title(App::getCoreExhibitionID()) !!}</h1>
	        @endif

	        @if ( App::get_field('exhibition_view_prompt',App::getCoreExhibitionID()) )
	        	<div class="highlighted_exhibition_button discover">
	        		<a href="{!! get_the_permalink(App::getCoreExhibitionID()) !!}" class="cta-round cta-outline">{{ App::get_field('exhibition_view_prompt',App::getCoreExhibitionID()) }}</a>
	        	</div>
	        @endif

	        {{-- print buy tickets button (if link added for this exhibition) --}}
			@include('partials.content-exhibition-ticket-button', ['wrapper_class'=>'highlighted_exhibition_button', 'ticket_url' => App::get_field('exhibition_ticket_button_link', App::getCoreExhibitionID())['url'], 'ticket_url_target'=>App::get_field('exhibition_ticket_button_link', App::getCoreExhibitionID())['target'], 'ticket_url_title'=>App::get_field('exhibition_ticket_button_link', App::getCoreExhibitionID())['title'], 'ticket_url_text'=>App::get_field('exhibition_ticket_button_text',App::getCoreExhibitionID())])

			{{-- print sponsors --}}
    		@if ( App::get_repeater_field('primary_sponsors_repeater', App::getCoreExhibitionID()) || App::get_repeater_field('secondary_sponsor_header', App::getCoreExhibitionID()) )
    			@include('partials.content-sponsors-switch')
    		@endif	

	    </div>
	</div>



    <!--
	@if (App::get_field('video_link','option'))
		<div class="full-video-link">
			<a href="{{ App::get_field('video_link','option') }}" class="cta-round cta-outline cta-arrow">@php _e("View Full Video","sage"); @endphp</a>
		</div>
	@endif -->
	@if(App::get_field('featured_video',App::getCoreExhibitionID()))
		<video autoplay muted loop id="herovideo" poster="{!! App::featuredImageSrc('large',App::getCoreExhibitionID()) !!}">
			<!--<source src="@asset('videos/auschwitz-intro.mp4')" type="video/mp4">-->
				<source src="{!! App::get_field('featured_video',App::getCoreExhibitionID()) !!}" type="video/mp4">
		</video>
	@else
		{!! App::featuredImage('large',App::getCoreExhibitionID()) !!}
	@endif
</div>