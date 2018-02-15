{{-- You must pass the post ID to this template as $item_id --}}
<div class="press-card">
  <a href="{!! get_the_permalink($item_id); !!}" class="card-link">
	<div class="date">{!! date('F j, Y',strtotime($press_item->post_date)) !!}</div>
    <div class="info">
      <h3 class="card-title">{{ App::truncateString(get_the_title($item_id), 10) }}</h3>
      @if (App::get_field('news_coverage',$item_id))
		<div class="news-coverage">{{App::get_field('news_coverage',$item_id)}}</div>
      @endif
    </div>
  </a>
</div>