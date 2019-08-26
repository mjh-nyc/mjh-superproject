@if ($ticket_url)
	<div class="{{ $wrapper_class }}">
		<a href="@if($ticket_url){!! $ticket_url !!} @else {{ App::get_field('exhibition_ticket_button_link',App::getCoreExhibitionID())['url'] }}@endif" @if($ticket_url_target) target="{!! $ticket_url_target !!}" @endif @if($ticket_url_title) title="{!! $ticket_url_title !!}" @endif class="cta-round cta-secondary">@if ($ticket_url_text) {!! $ticket_url_text !!} @else {!! _e("Buy Tickets","sage") !!} @endif</a>
	</div>
@endif