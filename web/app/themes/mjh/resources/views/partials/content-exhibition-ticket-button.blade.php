@if ($ticket_url)
	<div class="highlighted_exhibition_button">
		<a href="{{ App::get_field('exhibition_ticket_button_link',App::getCoreExhibitionID())['url'] }}" @if($ticket_url_target) target="{!! $ticket_url_target !!}" @endif @if($ticket_url_title) title="{!! $ticket_url_title !!}" @endif class="cta-round cta-secondary">@if ($ticket_url_text) {!! $ticket_url_text !!} @else {!! _e("Buy Tickets","sage") !!} @endif</a>
	</div>
@endif