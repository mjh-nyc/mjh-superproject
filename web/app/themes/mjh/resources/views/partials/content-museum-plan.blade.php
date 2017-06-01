<div class="museum-plan">
  <div class="header"><h1>Plan your visit</h1></div>
  <div class="museum-plans">
    <div class="plan-top">
      @include('partials.content-plan-deck-carousel')
      <div class="plan-item">
        <div class="plan-icon">[ICON]</div>
        <div class="plan-title">Tickets</div>
        <div class="content">
          <div>
            <div class="bold">Free admission for members and every Wednesday from 4 P.M.-8P.M.</div>
            <div class="small">*There may be a separate ticket fee for programs</div>
          </div>
          <div>
            <div>@php _e("Interested in becoming a member?","sage"); @endphp</div>
            <div class="bold"><a href="#">@php _e("Find out more","sage"); @endphp</a></div>
            <div><a class="button" href="#">@php _e("Buy Tickets","sage"); @endphp</a></div>
          </div>
        </div>
      </div>
      <div class="plan-item">
        <div class="plan-icon">[ICON]</div>
        <div class="plan-title">Hours &amp; Location</div>
        <div class="content">
          <div>
            <div class="bold">{!! $get_current_hours !!}</div>
            <div class="small">*Last admission to the Museum is <span="bold">30 minutes</span> prior to closing time</div>
          </div>
          <div>
            <div class="bold">{!! get_field('street_address', 'option') !!}</div>
            <div class="bold">{!! get_field('secondary_street_address', 'option') !!}</div>
            <div class="bold">{!! get_field('city_address', 'option') !!}, {!! get_field('state_address', 'option') !!} {!! get_field('zip_code_address', 'option') !!}</div>
            <div>{!! get_field('phone_number', 'option') !!}</div>
            <div><a class="button" href="#">@php _e("Plan your visit","sage"); @endphp</a></div>
          </div>
        </div>
      </div>
    </div>
      <div class="plan-bottom">
        <div class="plan-item">
          <div class="plan-title">Recommended by:</div>
            <ul>
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
