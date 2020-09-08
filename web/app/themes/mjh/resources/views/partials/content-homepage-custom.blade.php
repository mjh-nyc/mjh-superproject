<div class="wrap custom-section container-fluid no-gutters">
  <div class="custom-section--inner container">
    <div class="row">
      <div class="col-md-12">
        <div class="header">
          {!! get_sub_field('custom_section_title') !!}
        </div>
        @if(!empty(get_sub_field('custom_section_content_repeater')))
            <div class="custom-content">
            @while (have_rows('custom_section_content_repeater')) @php(the_row())
              <div class="custom-item">
                <div class="custom-item--title">{{ get_sub_field('custom_content_callout_title')}}</div>
                <div class="custom-item--content">
                  {!!  get_sub_field('custom_content_callout_copy') !!}
                </div>
              </div>
            @endwhile
            </div>
        @endif
      </div>
    </div>
  </div>
</div>
