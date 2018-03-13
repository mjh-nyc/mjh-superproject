@if ( ($post->post_type == 'event') && (App::get_field('event_type',get_the_ID()) == 'onetime'))
	@if( (App::get_field('event_type',get_the_ID()) == 'ongoing') || ( App::get_field('event_type',get_the_ID()) == 'onetime' && App::get_field('event_end_time') ) )
		<div class="calendar">
			<div class="calendar-header">
				&nbsp;
			</div>
			<div class="calendar-options">
				<div class="calendar-link">
					<span>@php _e("Add to my calendar: ","sage"); @endphp</span>
				</div>
				<div class="calendar-link">
					<a href="{!! get_stylesheet_directory_uri(); !!}/app/ics.php?eid={!! get_the_ID(); !!}" target="_blank" title="@php _e('Add to Apple calendar','sage'); @endphp"><i class="fa fa-calendar" aria-hidden="true"></i></a>
				</div>
			</div>
		</div>
	@endif
@endif