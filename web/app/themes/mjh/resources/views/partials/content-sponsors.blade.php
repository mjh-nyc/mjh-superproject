<div class="{{ $sectionType }}-sponsors {{ $sectionClass }}-sponsors sponsors">
  @if ($sectionType == 'primary')
    <h3 class="subhead">{{$sectionTitle}}</h3>
  @else
     <h4 class="subhead">{{$sectionTitle}}</h4>
  @endif
  <ul>
  @foreach (App::get_repeater_field( $sectionType.'_sponsors_repeater') as $sponsors)
    <li> 
      @if ($sponsors['sponsor_image'])
      <div class="{{ $sectionType }}-sponsor-image image">
        @if ($sponsors['sponsor_url'])<a href="{{ $sponsors['sponsor_url'] }}" target="_blank">@endif <img src="{!! $sponsors['sponsor_image']['sizes']['large'] !!}" alt="{!! $sponsors['sponsor_image']['alt'] !!}" title="{{$sponsors['sponsor_name']}}"> @if ($sponsors['sponsor_url'])</a>@endif
      </div>
      @else

        @if ($sponsors['sponsor_url'])<a href="{{ $sponsors['sponsor_url'] }}" target="_blank">@endif<div class="sponsor-name">{{$sponsors['sponsor_name']}}</div>@if ($sponsors['sponsor_url'])</a>@endif
        
      @endif
    </li>
  @endforeach
  </ul>
</div>