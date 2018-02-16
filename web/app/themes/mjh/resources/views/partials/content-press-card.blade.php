{{-- You must pass the post ID to this template as $item_id --}}
<div class="press-card ">
  <div class="press-card-wrapper slide-card">
    <a href="{!! get_the_permalink($item_id); !!}" class="card-link">
  	 <div class="date">
        {!! date('F j, Y',strtotime($press_item->post_date)) !!}
      </div>
      <div class="info">
        <h3 class="card-title">
          {{ App::truncateString(get_the_title($item_id), 10) }}
        </h3>
        @if (App::get_field('publication_logo',$item_id))
  		    <div class="publication_logo">{!! wp_get_attachment_image( App::get_field('publication_logo', $item_id ), 'medium' ) !!}</div>
        @endif
      </div>
    </a>
  </div>
</div>