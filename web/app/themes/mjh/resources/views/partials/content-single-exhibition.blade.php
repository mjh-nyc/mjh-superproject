<article @php(post_class())>
  <div class="col-content row">

    <div class="right-sidebar">
      <div class="exhibition-info">
        <h4 class="subhead">{{App::get_field('exhibition_type')}}</h4>
        @if (App::get_field('exhibition_start_date'))
          <p>{{App::get_field('exhibition_start_date')}} &#8211; {{App::get_field('exhibition_end_date')}}</p>
        @endif
        <div class="buy-tix">
          <a href="#" class="cta-round secondary">@php _e("Buy Tickets","sage"); @endphp</a>
        </div>
      </div>
    </div>

    <div class="entry-content">
      @include('partials.content-share')
      @php(the_content())
      @include('partials.content-related-links')
    </div>

    <div class="left-sidebar">
      <!-- Primary sponsors -->
      <div class="exhibition-primary-sponsors sponsors">
        <h4 class="subhead">@php _e("Sponsors","sage"); @endphp</h4>
        <div class="sponsor-name">
          Lorem Ipsum
        </div>
        <div class="exhibition-sponsor-image">
          <img src="http://mjh.local/app/uploads/2017/05/garden-of-stones-card-hero-150x150.jpg">
        </div>
      </div>

      <!-- Secondary sponsors -->
      <div class="exhibition-secondary-sponsors sponsors">
        <h4 class="subhead">@php _e("Special thanks to:","sage"); @endphp</h4>
        <div class="sponsor-name">
          <ul>
            <li>Consequunturn Magni</li>
            <li> Quia Conseguuntu</li>
            <li> Ratione Volupetem</li>
          </ul>
        </div>
      </div>
    </div>


  </div>
  <footer>
    
  </footer>
</article>
