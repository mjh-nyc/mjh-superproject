
<article @php(post_class(App::addSponsorsClass()))>
  <div class="col-content row">

    <div class="right-sidebar">
      <div class="event-info">
        <h4 class="subhead">@php _e("Event details","sage"); @endphp</h4>
        @if (App::get_repeater_field('event_dates'))
        <div class="event-dates">
          <ul>
            @foreach (App::get_repeater_field('event_dates') as $event_date)
              <li>{{ $event_date['event_start_date'] }} @if ($event_date['event_end_date']) &#8211; {{ $event_date['event_end_date'] }}@endif
              </li>
            @endforeach
          </ul>
        </div>
        @endif
        @if (App::get_field('event_has_location'))
          <div class="event-location">
            <div>{{App::get_field('event_location')}}</div>
            <div>{{App::get_field('event_street')}} {{App::get_field('event_secondary_street')}}</div>
            <div>{{App::get_field('event_city')}}, {{App::get_field('event_state')}} {{App::get_field('event_zip_code')}}</div>
          </div>
        @endif
        @if (App::get_repeater_field('event_pricing'))
        <div class="event-pricing">
          <ul>
            @foreach (App::get_repeater_field('event_pricing') as $event_pricing)
              <li><span class="price">${{ $event_pricing['event_price'] }}</span> {{ $event_pricing['event_price_label'] }}</li>
            @endforeach
          </ul>
        </div>
        @endif
        @if (App::get_field('event_ticket_url'))
        <div class="buy-tix">
          <a href="{!! App::get_field('event_ticket_url') !!}" target="_blank" class="cta-round secondary">@php _e("Buy Tickets","sage"); @endphp</a>
        </div>
        @endif
      </div>
    </div>

    <div class="entry-content">
      @include('partials.content-share')
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
