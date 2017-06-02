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
      @include('partials.content-gallery')
      @include('partials.content-related-links')
    </div>

    <div class="left-sidebar">
      <!-- Primary sponsors -->
      @include('partials.content-sponsors', ['sectionTitle' => __("Sponsors","sage"),'sectionClass'=>"exhibition",'sectionType'=>"primary"])

      <!-- Secondary sponsors -->
      @include('partials.content-sponsors', ['sectionTitle' => __("Special thanks to:","sage"),'sectionClass'=>"exhibition",'sectionType'=>"secondary"])
    </div>


  </div>
  <div class="related-content">
    {{-- TBD : actually pull 2 random exhibits that are not the current one, must only be for current on view or collection --}}
    @for ($i = 0; $i < 2; $i++)
        @php $item_id = '28'; @endphp
        @include('partials.content-exhibition-card')
    @endfor
  </div>
</article>
