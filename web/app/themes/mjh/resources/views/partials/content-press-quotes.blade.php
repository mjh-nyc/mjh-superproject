@if(count($press_quotes)>0)
  <div class="press-quotes">
    <div class="press-quotes--list">
      @for ($i = 0; $i < 2; $i++)
        <div class="press-quotes--item">
          <div class="press-quotes--item-text">
            <span class="leading-quote">&#8220;</span>{{ $press_quotes[$i]['press_quote'] }} &#8221;
          </div>
          <div class="press-quotes--source">
             @if ($press_quotes[$i]['press_source_logo'])
              <img src="{!! $press_quotes[$i]['press_source_logo']['sizes']['large'] !!}" alt="{!! $press_quotes[$i]['press_source_logo']['alt'] !!}" title="{{$press_quotes[$i]['press_source_name']}}">
             @else
              <span><em>— {{$press_quotes[$i]['press_source_name']}}</em></span> 
             @endif
          </div>
        </div>
      @endfor
      <div class="press-quotes--item see-more"> 
        <a class="see-more-arrow" href="{!! App::get_field('press_page_link','option') !!}"><span class="sr-only">{!! _e("See All","sage") !!}</span></a>
      </div>
    </div>
  </div>
@endif
