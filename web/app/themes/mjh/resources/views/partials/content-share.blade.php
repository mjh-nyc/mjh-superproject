<div class="share">
	<div class="share-header">
		@php _e("Share","sage"); @endphp
	</div>
	<div class="share-options">
		<div class="share-channel">
			<a href="https://www.facebook.com/sharer/sharer.php?u={!! get_the_permalink(); !!}" target="_blank" onclick="ga('send', 'event', 'social', 'share', 'facebook');"><i class="fa fa-facebook" aria-hidden="true"></i></a>
		</div>
		<div class="share-channel">
			<a href="https://twitter.com/intent/tweet?text={!! urlencode(App::postTitle()); !!}&url={!! get_the_permalink(); !!}&via={!! App::get_field('twitter_handle', 'option') !!}" onclick="ga('send', 'event', 'social', 'share', 'twitter');" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
		</div>
		@if ( App::featuredImageSrc() )
			<div class="share-channel">
				<a href="https://pinterest.com/pin/create/button/?url={!! get_the_permalink(); !!}&media={!! App::featuredImageSrc(); !!}&description={!! urlencode(App::postTitle()); !!}" onclick="ga('send', 'event', 'social', 'share', 'pinterest');" target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
			</div>
		@endif
		<div class="share-channel">
			<a href="https://www.linkedin.com/shareArticle?mini=true&url={!! get_the_permalink(); !!}&title={!! urlencode(App::postTitle()); !!}&summary={!! urlencode(App::postExcerpt()); !!}&source={!! get_bloginfo("name") !!}" target="_blank" onclick="ga('send', 'event', 'social', 'share', 'linkedin');"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
		</div>
		<div class="share-channel">
			<a href="mailto:?&subject=I thought you might find this interesting!&body={!! App::postTitle(); !!}%0A%0A{!! get_the_permalink(); !!}" onclick="ga('send', 'event', 'social', 'share', 'email');"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
		</div>
	</div>
</div>