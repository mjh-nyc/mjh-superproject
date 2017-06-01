@if (Homepage::planDeckCarouselItems())
<div class="plan-item">
	<div class="slider-plan-deck container">
		@foreach (Homepage::planDeckCarouselItems() as $plan_deck_carousel_item)
        <div class="card">
          @if($plan_deck_carousel_item['card_image'])
          <div class="card-image">
            <img src="{!! App::getAttachmentById($plan_deck_carousel_item['card_image']['ID'],'square@1x') !!}" />
          </div>
          @endif
          <div class="card-caption">{{$plan_deck_carousel_item['card_caption']}}</div>
          @if($plan_deck_carousel_item['card_url'])
          <div class="card_url">
            <a class="button" href="{!!$plan_deck_carousel_item['card_url']!!}">{!!$plan_deck_carousel_item['card_url_label']!!}</a>
          </div>
          @endif
        </div>
    	@endforeach
	</div>
</div>
@endif
