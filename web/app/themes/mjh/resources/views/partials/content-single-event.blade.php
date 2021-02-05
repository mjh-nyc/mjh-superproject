
@php
  $status = App::evalEventStatus(App::get_field('event_start_date'),App::get_field('event_end_date'));
  if ($status) {
    $status = 'past';
  }
@endphp
<article @php(post_class(App::addLayoutClasses()))>

  <div class="event-info {{ $status }}">
        <h3 class="subhead">
          @php _e("Event details","sage"); @endphp
        </h3>
        <div class="row">
        <div class="col-12">
        @if (App::get_field('event_start_date'))
        <div class="event-dates item">

          <div class="event-dates-content">
            <strong>
            @if (App::get_field('event_end_date'))
              {{ App::cleanDateOutput(App::get_field('event_start_date'),App::get_field('event_end_date')) }}
            @else
              {{ App::get_field('event_start_date') }}
            @endif
            </strong>
            @if (App::get_field('event_type') == 'onetime')
              <br> {{ App::get_field('event_start_time') }}
              @if (App::get_field('event_end_time'))
                  &#8211; {!! App::eventTime(get_post_meta(get_the_ID(),'event_end_time')) !!}
              @endif
            @endif
          </div>

        </div>
        @elseif (App::get_field('event_type') == 'recurring')
          <div class="event-dates item">
            <div class="event-dates-content">
              {{ App::get_field('event_recurrence') }}
            </div>
          </div>
        @endif
        @if (App::get_field('event_has_location'))
          <div class="event-location item">
            <div>{{App::get_field('event_location')}}</div>
            <div>{{App::get_field('event_street')}} <span style="display: block;">{{App::get_field('event_secondary_street')}}</span></div>
            <div>{{App::get_field('event_city')}}, {{App::get_field('event_state')}} {{App::get_field('event_zip_code')}}</div>
          </div>
        @endif
        </div>

        @if (App::get_repeater_field('event_pricing'))
          <div class="col-12">
            <div class="event-pricing item">
              <ul>
                @foreach (App::get_repeater_field('event_pricing') as $event_pricing)
                  <li>
                    <span class="bold">
                    @if(!empty($event_pricing['event_price_alternate']))
                      @if($event_pricing['event_price_alternate'] == 'Other')
                        {{ $event_pricing['event_price_alternate_other'] }}
                      @else
                        {{ $event_pricing['event_price_alternate'] }}
                      @endif
                    </span>
                    @else
                      ${{ $event_pricing['event_price'] }}
                      </span> {{$event_pricing['event_price_label'] }}
                    @endif
                  </li>
                @endforeach
              </ul>
            </div>
          </div>
        @endif
        @if (App::get_field('event_ticket_url') && !$status)
          <div class="col-12">
            <div class="buy-tix item">
              <a href="{!! App::get_field('event_ticket_url') !!}" target="_blank" class="cta-round cta-secondary">{!! App::get_field('event_ticket_button_label') !!}</a>
            </div>
          </div>
        @endif

        </div>
      </div>

  <div class="row back-link">
        <div class="single-event see-all">
          <a class="cta-round cta-outline cta-secondary" href="/events">@php _e("See all upcoming events","sage"); @endphp</a>
        </div>
      </div>

  <div class="col-content row">

    <div class="entry-content">

      @include('partials.content-share')
      @php(the_content())
      @include('partials.content-gallery')
      @include('partials.content-related-links')
      <div class="posts-links">
          @if ($get_previous_event)
          <div class="previous">
            <a href="{{$get_previous_event}}" class="cta-round cta-secondary cta-arrow-left">@php _e("Previous event","sage"); @endphp</a>
          </div>
          @endif
          @if ($get_next_event)
          <div class="next">
            <a href="{{$get_next_event}}" class="cta-round cta-secondary cta-arrow">@php _e("Next event","sage"); @endphp</a>
          </div>
           @endif
      </div>
  </div>
    </div>

     @if (App::get_repeater_field('primary_sponsors_repeater') || App::get_repeater_field('secondary_sponsors_repeater'))
      <div class="content-sponsors">

        @if (App::get_repeater_field('primary_sponsors_repeater'))
          <!-- Primary sponsors -->
          @include('partials.content-sponsors', ['sectionTitle' => App::get_field('primary_sponsor_header'),'sectionClass'=>"exhibition",'sectionType'=>"primary"])
        @endif

        @if (App::get_repeater_field('secondary_sponsors_repeater'))
          <!-- Secondary sponsors -->
          @include('partials.content-sponsors', ['sectionTitle' => App::get_field('secondary_sponsor_header'),'sectionClass'=>"exhibition",'sectionType'=>"secondary"])
        @endif
      </div>
    @endif
  <footer>

  </footer>
</article>
