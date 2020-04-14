@if ($special_feature)
  <div class="row special-feature no-gutters">
    
    @if ($special_feature['special_feature_image'])
      <div class="col-md-4 special-feature--image lazy" data-src="{{ $special_feature['special_feature_image']['url'] }}">
        <div class="sr-only">
          {{ $special_feature['special_feature_image']['alt'] }}
         </div>   
      </div>
    @endif
    <div class="@if ($special_feature['special_feature_image']) col-md-8 @else col-md-12 @endif special-feature--content">
      @if ($special_feature['special_feature_title'])
        <h2>{{ $special_feature['special_feature_title'] }}</h2>
      @endif
      @if ($special_feature['special_feature_content'])
        {!! $special_feature['special_feature_content'] !!}
      @endif
      @if ($special_feature['special_feature_link'])
        <a href="{{ $special_feature['special_feature_link']['url'] }}" class="cta-round">{{ $special_feature['special_feature_link']['title'] }}</a>
      @endif
    </div>
  </div>
@endif