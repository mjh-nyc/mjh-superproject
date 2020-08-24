<div class="museum-plan">
  <div class="header">
    {!! get_sub_field('about_section_title') !!}
  </div>
  <div id="museum-map">
    <iframe
      width="100%"
      height="100%"
      frameborder="0" style="border:0"
      src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBq67Jn1q5VZ7e3s8MgRTSI6tY6vqf359g
    &q=place_id:ChIJYTeZ_BFawokRe_SRVX_pKIs&center=40.7062532,-74.0022388" allowfullscreen>
    </iframe>
  </div>
  <div class="museum-plans">
    <div class="plan-top row">
      <div class="plan-item">
        <div class="plan-title">{{ get_sub_field('about_section_hours_title')}}</div>
        <div class="content">
          {!!  get_sub_field('about_section_hours_copy') !!}
        </div>
      </div>
      <div class="plan-item">
        <div class="plan-title">{{ get_sub_field('about_section_visitor_title') }}</div>
        <div class="content">
          @if(!empty(get_sub_field('about_section_visitor_links_repeater')))
            <ul class="links">
            @while (have_rows('about_section_visitor_links_repeater')) @php(the_row())
              <li class="link">
                <a href="{{ get_sub_field('about_section_visitor_links_link')['url'] }}" target="{{ get_sub_field('about_section_visitor_links_link')['target'] }}">{{ get_sub_field('about_section_visitor_links_link')['title'] }}</a>
              </li>
            @endwhile
            </ul>
          @endif
          <div class="ticket">
            @if (App::get_field('buy_tickets_button_url','option'))
              <a class="cta-round cta-arrow cta-secondary" href="{{ App::get_field('buy_tickets_button_url','option') }}">{{ App::get_field('buy_tickets_button_label','option') }}</a>
            @endif
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
