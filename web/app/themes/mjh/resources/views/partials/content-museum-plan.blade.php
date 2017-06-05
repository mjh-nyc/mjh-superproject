<div class="container museum-plan">
  <div class="header">
    <h1>Plan your visit</h1>
  </div>
  <div class="museum-plans">
    <div class="plan-top row justify-content-center">
      <div class="plan-item">
        <div class="plan-icon"><img src="@asset('images/tickets.svg')" alt="{!! _e('Tickets','sage') !!}"></div>
        <div class="plan-title">{!! _e('Tickets','sage') !!}</div>
        <div class="content">
          <div>
            <p class="bold">Purchase Museum admission tickets in advance for a discount.</p>
            <p class="small">There may be a separate ticket fee for programs.</p>
          </div>
          <div>
            <p>{!! _e('Interested in getting free admission by becoming a member?','sage') !!}<br>
            <span class="bold"><a href="/join/" style="text-decoration: underline;">{!! _e('Find out more','sage') !!}</a></p>
            <div><a class="cta-round cta-arrow cta-secondary" href="/tickets/">@php _e("Buy Tickets","sage"); @endphp</a></div>
          </div>
        </div>
      </div>
      <div class="plan-item">
        <div class="plan-icon" style="margin-top: 10px;height: 60px;"><img src="@asset('images/mjh_logo_icon.svg')" alt="{!! _e("Museum building icon","sage") !!}"></div>
        <div class="plan-title">{!! _e('Hours &amp; Location','sage') !!}</div>
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
            <div><a class="cta-round cta-arrow cta-secondary" href="/location-directions/">{!! _e('Plan Your Visit','sage') !!}</a></div>
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
