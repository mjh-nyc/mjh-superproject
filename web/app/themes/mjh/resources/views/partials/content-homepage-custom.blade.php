<div class="container">
  <div class="custom-section">
    <div class="header">
      {!! get_sub_field('custom_section_title') !!}
    </div>
    @if(!empty(get_sub_field('custom_section_content_repeater')))
        <div class="custom-content row">
        @while (have_rows('custom_section_content_repeater')) @php(the_row())
          <div class="custom-item">
            <div class="custom-title">{{ get_sub_field('custom_content_callout_title')}}</div>
            <div class="content">
              {!!  get_sub_field('custom_content_callout_copy') !!}
            </div>
          </div>
        @endwhile
        </div>
    @endif
  </div>
</div>
