<div class="container museum-plan">
  <div class="header">
    <h1>{!! _e('Plan your visit','sage') !!}</h1>
  </div>
  <div class="museum-plans">
    <div class="plan-top row justify-content-center">
      <div class="plan-item">
        <div class="plan-icon"><img src="@asset('images/tickets.svg')" alt="{!! _e('Tickets','sage') !!}"></div>
        <div class="plan-title">{{ App::get_field('tickets_header','option')}}</div>
        <div class="content">
          {!! App::get_field('ticketing_information','option') !!}
          @if (App::get_field('buy_tickets_button','option'))
            <a class="cta-round cta-arrow cta-secondary" href="{{ App::get_field('buy_tickets_button_url','option') }}">{{ App::get_field('buy_tickets_button_label','option') }}</a>
          @endif
          
        </div>
      </div>
      <div class="plan-item">
        <div class="plan-icon" style="margin-top: 10px;height: 60px;"><img src="@asset('images/mjh_logo_icon.svg')" alt="{!! _e("Museum building icon","sage") !!}"></div>
        <div class="plan-title">{{ App::get_field('hours_and_location_header','option') }}</div>
        <div class="content">
          <div>
            <p class="bold">{!! $get_current_schedule_text !!}</p>
            <!--<p>{!! get_field('regular_hours_additional_notes', 'option') !!}</p>
            <p>{!! get_field('holiday_additional_notes', 'option') !!}</p>-->
          </div>
          <div>
            <p><span class="bold">{!! get_field('street_address', 'option') !!}<br>
            {!! get_field('secondary_street_address', 'option') !!}<br>
            {!! get_field('city_address', 'option') !!}, {!! get_field('state_address', 'option') !!} {!! get_field('zip_code_address', 'option') !!}</span><br>
            {!! get_field('phone_number', 'option') !!}</p>
            @if (App::get_field('plan_your_visit_button_url','option'))
              <div><a class="cta-round cta-arrow cta-secondary" href="{{ App::get_field('plan_your_visit_button_url','option') }}">{{ App::get_field('plan_your_visit_button_label','option') }}</a></div>
            @endif
          </div>
        </div>
      </div>
      @include('partials.content-plan-deck-carousel')
    </div>
    <div class="plan-bottom">
      <div class="plan-item">
        <div class="plan-title">{!! _e('Recommended by:','sage') !!}</div>
        <ul class="bold">
          <li><a href="https://www.yelp.com/biz/museum-of-jewish-heritage-a-living-memorial-to-the-holocaust-new-york" target="_blank" onclick="return trackOutboundLink('https://www.yelp.com/biz/museum-of-jewish-heritage-a-living-memorial-to-the-holocaust-new-york', true)"><img src="@asset('images/Yelp_trademark_RGB.png')" style="height:50px; opacity: .5" alt="Yelp" /></a></li>
          <li><a href="https://www.tripadvisor.com/Attraction_Review-g60763-d555968-Reviews-Museum_of_Jewish_Heritage-New_York_City_New_York.html" target="_blank" onclick="return trackOutboundLink('https://www.tripadvisor.com/Attraction_Review-g60763-d555968-Reviews-Museum_of_Jewish_Heritage-New_York_City_New_York.html', true)"><img src="@asset('images/Trip Advisor Logo.png')" style="opacity: .5" alt="Trip Advisor" /></a></li>
          <li><a href="https://www.timeout.com/newyork/museums/museum-of-jewish-heritagea-living-memorial-to-the-holocaust" target="_blank" onclick="return trackOutboundLink('https://www.timeout.com/newyork/museums/museum-of-jewish-heritagea-living-memorial-to-the-holocaust', true)"><img src="@asset('images/time-out-new-york-logo.png')" style="opacity: .5" alt="Timeout New York<" /></a></li>
          <li><a href="https://www.lonelyplanet.com/usa/new-york-city/attractions/museum-of-jewish-heritage/a/poi-sig/1105969/362079" target="_blank" onclick="return trackOutboundLink('https://www.lonelyplanet.com/usa/new-york-city/attractions/museum-of-jewish-heritage/a/poi-sig/1105969/362079', true)"><img src="@asset('images/800px-Lonely_Planet.png')" style="opacity: .5" alt="Lonely Planet" /></a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
</div>
