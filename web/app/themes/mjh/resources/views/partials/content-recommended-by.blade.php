@if(!empty(get_sub_field('about_section_recommendations_repeater')))
  <div class="recommended-by-content">
      <div class="plan-item">
        <div class="plan-title">{!! get_sub_field('about_section_recommendation_title') !!}</div>
        <ul class="bold">
          @while (have_rows('about_section_recommendations_repeater')) @php(the_row())
          <li><img src="{!! get_sub_field('about_section_recommendation_icon')['url'] !!}" class="lazy" style="height:50px; opacity: .5" alt="{!!get_sub_field('about_section_recommendation_title')!!}" /></li>
          @endwhile
        </ul>
      </div>
  </div>
@endif
