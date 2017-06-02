@if (App::get_repeater_field('primary_sponsors_repeater'))
<div class="{{ $sectionType }}-sponsors {{ $sectionClass }}-sponsors">
  <h4 class="subhead">{{$sectionTitle}}</h4>
  <ul>
  @foreach (App::get_repeater_field( $sectionType.'_sponsors_repeater') as $sponsors)
    <li>
      @if ($sponsors['sponsor_image'])
      <div class="{{ $sectionType }}-sponsor-image image">
        @if ($sponsors['sponsor_url'])<a href="{{ $sponsors['sponsor_url'] }}" target="_blank">@endif <img src="{!! App::getAttachmentById($sponsors['sponsor_image']['ID'],'thumbnail') !!}"> @if ($sponsors['sponsor_url'])</a>@endif
      </div>
      @endif
      @if ($sponsors['sponsor_url'])<a href="{{ $sponsors['sponsor_url'] }}" target="_blank">@endif<div class="sponsor-name">{{$sponsors['sponsor_name']}}</div>@if ($sponsors['sponsor_url'])</a>@endif
    </li>
  @endforeach
  </ul>
</div>
@endif
