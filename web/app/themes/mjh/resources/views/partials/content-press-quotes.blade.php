<a href="/auschwitz-exhibition-press/in-the-news/"><img src="@asset('images/Press-callouts.png')" alt="Temp" style="width: 100%; height: auto; margin-top: 2rem;"></a>

  <!--
  @if(App::get_repeater_field( 'press_quotes' ))
    <div class="press-quotes">
      <div class="press-quotes--list">

        @foreach (App::get_repeater_field( 'press_quotes' ) as $quote)
          <div class="press-quotes--item">
            <div class="press-quotes--item-text">
              {{ $quote['press_quote'] }}
            </div>
            <div class="press-quotes--source">
               @if ($quote['press_source_logo'])
                <img src="{!! $quote['press_source_logo']['sizes']['large'] !!}" alt="{!! $quote['press_source_logo']['alt'] !!}" title="{{$quote['press_source_name']}}">
               @else
                <span><em>— {{$quote['press_source_name']}}</em></span> 
               @endif
            </div>
          </div>
        @endforeach
      </div>
    </div>
  @endif
-->