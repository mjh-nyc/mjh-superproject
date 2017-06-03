<div class="container museum-plan">
  <div class="header">
    <h1>Plan your visit</h1>
  </div>
  <div class="museum-plans">
    <div class="plan-top row justify-content-center">
      <div class="plan-item">
        <div class="plan-icon"><img src="../app/themes/mjh/dist/images/tickets.svg" alt="'.__("Tickets","sage").'"></div>
        <div class="plan-title">Tickets</div>
        <div class="content">
          <div>
            <p class="bold">Free admission for members and every Wednesday from 4 P.M.-8P.M.</p>
            <p class="small">*There may be a separate ticket fee for programs</p>
          </div>
          <div>
            <p>@php _e("Interested in becoming a member?","sage"); @endphp<br>
            <span class="bold"><a href="#">@php _e("Find out more","sage"); @endphp</a></p>
            <div><a class="cta-round cta-arrow cta-secondary" href="#">@php _e("Buy Tickets","sage"); @endphp</a></div>
          </div>
        </div>
      </div>
      <div class="plan-item">
        <div class="plan-icon"><img src="../app/themes/mjh/dist/images/mjh_logo_icon.svg" alt="'.__("MJH","sage").'"></div>
        <div class="plan-title">Hours &amp; Location</div>
        <div class="content">
          <div>
            <p class="bold">{!! $get_current_schedule_text !!}</p>
            <p>{!! get_field('regular_hours_additional_notes', 'option') !!}</p>
            <p>{!! get_field('holiday_additional_notes', 'option') !!}</p>
          </div>
          <div>
            <p><span class="bold">{!! get_field('street_address', 'option') !!}<br>
            {!! get_field('secondary_street_address', 'option') !!}<br>
            {!! get_field('city_address', 'option') !!}, {!! get_field('state_address', 'option') !!} {!! get_field('zip_code_address', 'option') !!}</span><br>
            {!! get_field('phone_number', 'option') !!}</p>
            <div><a class="cta-round cta-arrow cta-secondary" href="#">@php _e("Plan your visit","sage"); @endphp</a></div>
          </div>
        </div>
      </div>
      @include('partials.content-plan-deck-carousel')
    </div>
    <div class="plan-bottom">
      <div class="plan-item">
        <div class="plan-title">Recommended by:</div>
        <ul class="bold">
          <li><a href="#">Yelp</a></li>
          <li><a href="#">Trip Advisor</a></li>
          <li><a href="#">Timeout New York</a></li>
          <li><a href="#">Lonely Planet</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
</div>
