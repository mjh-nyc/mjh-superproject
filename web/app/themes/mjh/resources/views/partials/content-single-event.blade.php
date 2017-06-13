
<article @php(post_class(App::addLayoutClasses()))>
  <div class="col-content row">

    <div class="right-sidebar">
      <div class="event-info">
        <h4 class="subhead">@php _e("Event details","sage"); @endphp</h4>
        <div class="row">
        <div class="col-md-6 col-lg-12">
        @if (App::get_repeater_field('event_dates'))
        <div class="event-dates item">
          <ul>
            @foreach (App::get_repeater_field('event_dates') as $event_date)
              <li>{!! App::cleanDateOutput($event_date['event_start_date'] , $event_date['event_end_date'])!!}
              </li>
            @endforeach
          </ul>
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
        <div class="col-md-6 col-lg-12">
        @if (App::get_repeater_field('event_pricing'))
        <div class="event-pricing item">
          <ul>
            @foreach (App::get_repeater_field('event_pricing') as $event_pricing)
              <li><span class="bold">${{ $event_pricing['event_price'] }}</span> {{ $event_pricing['event_price_label'] }}</li>
            @endforeach
          </ul>
        </div>
        @endif
        @if (App::get_field('event_ticket_url'))
        <div class="buy-tix">
          <a href="{!! App::get_field('event_ticket_url') !!}" target="_blank" class="cta-round cta-secondary">@php _e("Get Tickets","sage"); @endphp</a>
        </div>
        @endif
        </div>
        </div>
      </div>
    </div>

    <div class="entry-content">
      <div class="row">
        <div class="col-md-8">
          @include('partials.content-share')
        </div>
        <div class="cold-md-4 see-all">
          @php _e("All events","sage"); @endphp
        </div>
      </div>
      @php(the_content())
      @include('partials.content-related-links')
    </div>

     @if (App::get_repeater_field('primary_sponsors_repeater') || App::get_repeater_field('secondary_sponsor_header'))
      <div class="left-sidebar">

        @if (App::get_repeater_field('primary_sponsors_repeater'))
          <!-- Primary sponsors -->
          @include('partials.content-sponsors', ['sectionTitle' => App::get_field('primary_sponsor_header'),'sectionClass'=>"exhibition",'sectionType'=>"primary"])
        @endif

        @if (App::get_repeater_field('secondary_sponsor_header'))
          <!-- Secondary sponsors -->
          @include('partials.content-sponsors', ['sectionTitle' => App::get_field('secondary_sponsor_header'),'sectionClass'=>"exhibition",'sectionType'=>"secondary"])
        @endif
      </div>
    @endif

  </div>
  <footer>

  </footer>
</article>
