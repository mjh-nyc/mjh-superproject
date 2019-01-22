<div class="container museum-plan">
  <div class="header">
    {!! _e('Plan your visit','sage') !!}
  </div>
  <div class="museum-plans">
    <div class="plan-top row justify-content-center">
      <div class="plan-item">
        <!--<div class="plan-icon"><img src="@asset('images/tickets.svg')" alt="{!! _e('Tickets','sage') !!}"></div>-->
        <div class="plan-title">{{ App::get_field('tickets_header','option')}}</div>
        <div class="content">
          {!! App::get_field('ticketing_information','option') !!}
          @if (App::get_field('buy_tickets_button_url','option'))
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
  </div>
</div>
</div>
