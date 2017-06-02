<article @php(post_class())>
  <div class="col-content row">

    <div class="right-sidebar">
      <div class="event-info">
        <h4 class="subhead">@php _e("Event details","sage"); @endphp</h4>
        @if (App::get_repeater_field('event_dates'))
        <div class="event-dates">
          <ul>
            @foreach (App::get_repeater_field('event_dates') as $event_date)
              <li>{{ $event_date['event_start_date'] }} @if ($event_date['event_end_date']) &#8211; {{ $event_date['event_end_date'] }}@endif
            @endforeach
          </ul>
        </div>
        @endif
        <div class="event-location">
          <div>{{App::get_field('event_location')}}</div>
          <div>{{App::get_field('event_street')}} {{App::get_field('event_secondary_street')}}</div>
          <div>{{App::get_field('event_city')}}, {{App::get_field('event_state')}} {{App::get_field('event_zip_code')}}</div>
        </div>
        @if (App::get_repeater_field('event_pricing'))
        <div class="event-pricing">
          <ul>
            @foreach (App::get_repeater_field('event_pricing') as $event_pricing)
              <li>${{ $event_pricing['event_price'] }} {{ $event_pricing['event_price_label'] }}</li>
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

    <div class="left-sidebar">
      <!-- Primary sponsors -->
      @include('partials.content-sponsors', ['sectionTitle' => __("Presented by","sage"),'sectionClass'=>"event",'sectionType'=>"primary"])

      <!-- Secondary sponsors -->
      @include('partials.content-sponsors', ['sectionTitle' => __("Co-presented by","sage"),'sectionClass'=>"event",'sectionType'=>"secondary"])
    </div>

  </div>
  <footer>

  </footer>
</article>
