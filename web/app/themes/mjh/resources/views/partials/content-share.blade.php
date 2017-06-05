<div class="share">
	<div class="share-header">
		@php _e("Share","sage"); @endphp
	</div>
	<div class="share-options">
		<div class="share-channel">
			<a href="https://www.facebook.com/sharer/sharer.php?u={!! get_the_permalink(); !!}" target="_blank" onclick="ga('send', 'event', 'social', 'share', 'facebook');"><i class="fa fa-facebook" aria-hidden="true"></i></a>
		</div>
		<div class="share-channel">
			<a href="https://twitter.com/intent/tweet?text={!! urlencode(App::postTitle()); !!}&via={!! App::get_field('twitter_handle', 'option') !!}" onclick="ga('send', 'event', 'social', 'share', 'twitter');" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
		</div>
		<div class="share-channel">
			<a href="https://pinterest.com/pin/create/button/?url={!! get_the_permalink(); !!}&media={!! App::featuredImageSrc(); !!}&description={!! urlencode(App::postTitle()); !!}" onclick="ga('send', 'event', 'social', 'share', 'pinterest');" target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
		</div>
		<div class="share-channel">
			<a href="#"><i class="fa fa-tumblr" aria-hidden="true"></i></a>
		</div>
		<div class="share-channel">
			<a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
		</div>
	</div>
</div>