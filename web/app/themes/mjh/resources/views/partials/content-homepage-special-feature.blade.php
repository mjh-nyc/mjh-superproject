<div class="container">
  <div class="row special-feature no-gutters">
    @if (get_sub_field('special_feature_image'))
      @php($special_feature_image = get_sub_field('special_feature_image'))
      <div class="col-md-4 special-feature--image lazy" data-src="{{ $special_feature_image['sizes']['square@1x'] }}|{{ $special_feature_image['sizes']['square@2x'] }}">
        <div class="sr-only">
          {{ $special_feature_image['alt'] }}
         </div>
      </div>
    @endif
    <div class="@if (get_sub_field('special_feature_image')) col-md-8 @else col-md-12 @endif special-feature--content">
      @if (get_sub_field('special_feature_title'))
        <h2>{{ get_sub_field('special_feature_title') }}</h2>
      @endif
      @if (get_sub_field('special_feature_content'))
        {!! get_sub_field('special_feature_content') !!}
      @endif
      @if (get_sub_field('special_feature_link'))
        @php($special_feature_link = get_sub_field('special_feature_link'))
        <a href="{{ $special_feature_link['url'] }}" target="{{ $special_feature_link['target'] }}" class="cta-round">{{ $special_feature_link['title'] }}</a>
      @endif
    </div>
  </div>
</div>
