<article @php(post_class(App::addLayoutClasses()))>
  
  @if (App::get_field('exhibition_admission_required'))
      <div class="exhibition-info">
          <h3 class="subhead">{{App::get_field('exhibition_type')}}</h3>
          @if (App::get_field('exhibition_start_date'))
              <p>{{App::get_field('exhibition_start_date')}} &#8211; {{App::get_field('exhibition_end_date')}}</p>
          @endif
          @if  (empty($is_exhibtion_past))
            <div class="buy-tix">
              <a href="/tickets/" class="cta-round cta-secondary">@php _e("Buy Tickets","sage"); @endphp</a>
            </div>
          @endif
      </div>
      
    @endif

  <div class="row back-link">
        <div class="single-exhibition see-all">
          <a class="cta-round cta-outline cta-secondary" href="/current-exhibitions/">@php _e("See all current exhibitions","sage"); @endphp</a>
        </div>
      </div>

  <div class="col-content row">


    <div class="entry-content">
      @include('partials.content-share')
      @php(the_content())
      @include('partials.content-related-events')
      @include('partials.content-gallery')
      @include('partials.content-related-links')
      
    </div>
  </div>
  @if (App::get_repeater_field('primary_sponsors_repeater') || App::get_repeater_field('secondary_sponsor_header'))
    <div class="content-sponsors">

      @if (App::get_repeater_field('primary_sponsors_repeater'))
        <!-- Primary sponsors -->
        @include('partials.content-sponsors', ['sectionTitle' => App::get_field('primary_sponsor_header'),'sectionClass'=>"exhibition",'sectionType'=>"primary"])
      @endif

      @if (App::get_repeater_field('secondary_sponsors_repeater'))
        <!-- Secondary sponsors -->
        @include('partials.content-sponsors', ['sectionTitle' => App::get_field('secondary_sponsor_header'),'sectionClass'=>"exhibition",'sectionType'=>"secondary"])
      @endif
    </div>
  @endif
  @if ($exhibitions_widget_listings && empty($is_exhibtion_past))
    <div class="related-content">
      <div class="header">
        @if (!empty($is_exhibtion_upcoming))
          {{ __('Also Upcoming', 'sage') }}
        @else
          {{ __('Also on View', 'sage') }}
        @endif
      </div>
      <div class="row no-gutters">
        @foreach ($exhibitions_widget_listings as $exhibition_widget)
            @include('partials.content-exhibition-card', ['item_id'=>$exhibition_widget->ID, 'header'=>''])
        @endforeach
      </div>
    </div>
  @endif
</article>
