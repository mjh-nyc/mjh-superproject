<div class="calendar">
	<div class="calendar-header">
		@php _e("Add to calendar","sage"); @endphp
	</div>
	<div class="calendar-options">
		<div class="calendar-link">
			<a href="{!! get_stylesheet_directory_uri(); !!}/app/ics.php?eid={!! get_the_ID(); !!}" target="_blank"><i class="fa fa-calendar" aria-hidden="true"></i></a>
		</div>
	</div>
</div>