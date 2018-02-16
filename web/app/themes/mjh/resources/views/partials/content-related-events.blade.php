@if (App::get_repeater_field('related_events_repeater'))
	<div class="related-events">
		<div class="subhead">@php _e("Related Events","sage"); @endphp</div>
		<div class="related_events_list">
			@foreach (App::get_repeater_field('related_events_repeater') as $related_event)
				<div class="related_event_container">




					@php $item_id = $related_event['event']->ID @endphp

					@if (has_post_thumbnail($item_id ))
						<div class="related_event_thumb">
							{!! get_the_post_thumbnail($item_id,'square@1x') !!}
						</div>
					@endif
					<div class="related_event_content @if (!has_post_thumbnail($item_id )) full_width @endif">
					
						<div class="details">
					      @if (App::get_field('event_start_date',$item_id))
						      <div class="event-dates">
						          	@if (App::get_field('event_end_date',$item_id) && App::get_field('event_type',$item_id) == 'ongoing')
					                {{ date('l',strtotime(App::get_field('event_start_date',$item_id))) }} / 
						          		{{ App::cleanDateOutput(App::get_field('event_start_date',$item_id),App::get_field('event_end_date',$item_id)) }}
						          	@else
					                {!! date('l',strtotime(App::get_field('event_start_date',$item_id))) !!} / 
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

				    	<div class="related-event-title">
				    		{{ $related_event['event']->post_title }}
				    	</div>
				    	<div>
				    		<a class="cta-round cta-arrow cta-secondary" href="{!! App::getPermalink($related_event['event']->ID); !!}">@php _e("Event details","sage"); @endphp</a>
				    	</div>
					
					</div>
					

					
				</div>

			



			@endforeach
		</div>
	</div> 
@endif