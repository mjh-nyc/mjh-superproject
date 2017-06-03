<article @php(post_class(App::addSponsorsClass()))>
  <div class="col-content row">

    <div class="right-sidebar">
      <div class="exhibition-info">
        <h4 class="subhead">{{App::get_field('exhibition_type')}}</h4>
        @if (App::get_field('exhibition_start_date'))
          <p>{{App::get_field('exhibition_start_date')}} &#8211; {{App::get_field('exhibition_end_date')}}</p>
        @endif
        <div class="buy-tix">
          <a href="#" class="cta-round cta-secondary">@php _e("Buy Tickets","sage"); @endphp</a>
        </div>
      </div>
    </div>

    <div class="entry-content">
      @include('partials.content-share')
      @php(the_content())
      @include('partials.content-gallery')
      @include('partials.content-related-links')
    </div>

    @if (App::get_repeater_field('primary_sponsors_repeater') || App::get_repeater_field('secondary_sponsor_header'))
      <div class="left-sidebar">
        
        @if (App::get_repeater_field('primary_sponsors_repeater'))
          <!-- Primary sponsors -->
          @include('partials.content-sponsors', ['sectionTitle' => App::get_field('primary_sponsor_header'),'sectionClass'=>"exhibition",'sectionType'=>"primary"])
        @endif

        @if (App::get_repeater_field('secondary_sponsor_header'))
          <!-- Secondary sponsors -->
          @include('partials.content-sponsors', ['sectionTitle' => App::get_field('secondary_sponsor_header'),'sectionClass'=>"exhibition",'sectionType'=>"secondary"])
        @endif
      </div>
    @endif


  </div>
  <div class="related-content">
    <div class="header">
      {{ __('Also on View', 'sage') }}
    </div>
    <div class="row no-gutters">
    {{-- TBD : actually pull 2 random exhibits that are not the current one, must only be for current on view or collection --}}
    @for ($i = 0; $i < 2; $i++)
        @php $item_id = '28'; @endphp
        @include('partials.content-exhibition-card')
    @endfor
    </div>
  </div>
</article>
