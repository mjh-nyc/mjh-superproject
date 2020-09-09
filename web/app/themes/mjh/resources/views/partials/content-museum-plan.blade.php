<div class="header">
  {!! get_sub_field('about_section_title') !!}
</div>
<div class="museum-plan-wrapper">
  <div id="museum-map">
    <iframe
      width="100%"
      height="600px"
      frameborder="0" style="border:0"
      src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBq67Jn1q5VZ7e3s8MgRTSI6tY6vqf359g
    &q=place_id:ChIJYTeZ_BFawokRe_SRVX_pKIs&center=40.7062532,-74.0022388&zoom=16" allowfullscreen>
    </iframe>
  </div>
  <div class="museum-map-overlay container">
    <div class="plan-top row">
      <div class="plan-item">
        <div class="plan-title">{{ get_sub_field('about_section_hours_title')}}</div>
        <div class="content">
          {!! $get_current_schedule_text !!}
          <div class="small">
            {!!  get_sub_field('about_section_hours_copy') !!}
          </div>
        </div>
      </div>
      <div class="plan-item">
        <div class="plan-title">{{ get_sub_field('about_section_visitor_title') }}</div>
        <div class="content">
          @php $info_links = get_sub_field('about_section_visitor_links_repeater') @endphp
          @if(!empty($info_links))
            <ul class="links">

              @foreach( $info_links as $info_link )
                @if($loop->last)
                  @php
                    $button_label = $info_link['about_section_visitor_links_link']['title'];
                    $button_url = $info_link['about_section_visitor_links_link']['url'];
                    $button_target = $info_link['about_section_visitor_links_link']['target'];
                  @endphp
                @else
                  <li class="link">
                    <a href="{{ $info_link['about_section_visitor_links_link']['url'] }}" target="{{ $info_link['about_section_visitor_links_link']['target'] }}">{{ $info_link['about_section_visitor_links_link']['title'] }}</a>
                  </li>
                @endif
              @endforeach

            </ul>
            <div class="ticket">
              <a class="cta-round cta-arrow cta-secondary" href="{{ $button_url }}" target="{{ $button_target }}">{{ $button_label }}</a>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
