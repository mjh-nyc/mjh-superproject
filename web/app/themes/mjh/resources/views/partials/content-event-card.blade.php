{{-- You must pass the post ID to this template as $item_id --}}
<div class="event-card slide-card">
  <a href="{!! get_the_permalink($item_id); !!}" class="card-link">
    <div class="card-image" style="background-image:url({{App::featuredImageSrc('square@1x',$item_id)}})">
      <span class="sr-only">{{ App::featuredImageAlt($item_id) }}</span>
      <span class="card-category" @if (App::get_field('event_type',$item_id) == 'recurring') style="background:#033EFB" @endif >{!! App::postTermsString($item_id,'event_category') !!}</span>
    </div>
    <div class="info">
      <h3 class="card-title">{{ App::truncateString(get_the_title($item_id), 20) }}</h3>
      <!--<p class="description">{{App::postExcerpt($item_id)}}</p>-->
    </div>
    <div class="details">
      @if (App::get_field('event_start_date',$item_id))
	      <div class="event-dates">
	          	@if (App::get_field('event_end_date',$item_id) && App::get_field('event_type',$item_id) == 'ongoing')
                {{ date('l',strtotime(App::get_field('event_start_date',$item_id))) }}</br>
	          		{{ App::cleanDateOutput(App::get_field('event_start_date',$item_id),App::get_field('event_end_date',$item_id)) }}
	          	@else
                {!! date('l',strtotime(App::get_field('event_start_date',$item_id))) !!}</br>
	          		{{ App::get_field('event_start_date',$item_id) }} 
	          	@endif
	          	@if (App::get_field('event_type',$item_id) == 'onetime' && App::get_field('event_start_time',$item_id))
	          		/ {{ App::get_field('event_start_time',$item_id) }}
		        @endif
	      </div>
      @elseif (App::get_field('event_type',$item_id) == 'recurring')
      	<div class="event-dates event-recurrence">
      		<i class="fa fa-bullseye" aria-hidden="true"></i> {{ App::get_field('event_recurrence',$item_id) }}
      	</div>
	  @endif
    </div>
  </a>
</div>