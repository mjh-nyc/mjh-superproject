@if (Homepage::planDeckCarouselItems())
<div class="plan-item flex-lg-first">
	<div class="slider-plan-deck mjh-slider">
		@foreach (Homepage::planDeckCarouselItems() as $plan_deck_carousel_item)
        <div class="slide-card">
          @if($plan_deck_carousel_item['card_image'])
          <div class="card-image" style="background-image:url('{!! App::getAttachmentById($plan_deck_carousel_item['card_image']['ID'],'square@1x') !!}')">
            <span class="sr-only">{{App::get_field('hero_image',$item['carousel_item'])['alt']}}</span>
          </div>
          @endif
          <div class="card-caption">{{$plan_deck_carousel_item['card_caption']}}</div>
          @if($plan_deck_carousel_item['card_url'])
          <div class="card_url">
            <a class="cta-round cta-outline cta-secondary" href="{!!$plan_deck_carousel_item['card_url']!!}">{!!$plan_deck_carousel_item['card_url_label']!!}</a>
          </div>
          @endif
        </div>
    	@endforeach
	</div>
</div>
@endif
