@if ($ticket_url)
	<div class="{{ $wrapper_class }}">
		<a href="{!! $ticket_url !!}" @if($ticket_url_target) target="{!! $ticket_url_target !!}" @endif @if($ticket_url_title) title="{!! $ticket_url_title !!}" @endif class="cta-round cta-secondary">@if ($ticket_url_text) {!! $ticket_url_text !!} @else {!! _e("Buy Tickets","sage") !!} @endif</a>
	</div>
@endif