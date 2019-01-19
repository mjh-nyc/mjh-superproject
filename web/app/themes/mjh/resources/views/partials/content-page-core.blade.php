@if (App::get_field('exhibition_admission_required', App::getCoreExhibitionID()))
	<div class="exhibition-info">
		<!--<h3 class="subhead">{{App::get_field('exhibition_type', App::getCoreExhibitionID())}}</h3>-->
		<!-- //TODO -->
		<h3 class="subhead">{{ App::get_field('exhibition_tickets_prompt',App::getCoreExhibitionID()) }}</h3>
		@if (App::get_field('exhibition_start_date', App::getCoreExhibitionID()))
		  <p>{{App::get_field('exhibition_start_date', App::getCoreExhibitionID())}} &#8211; {{App::get_field('exhibition_end_date', App::getCoreExhibitionID())}}</p>
		@endif

		{{-- print buy tickets button (if link added for this exhibition) --}}
    	@include('partials.content-exhibition-ticket-button', ['wrapper_class'=>'buy-tix', 'ticket_url' => App::get_field('exhibition_ticket_button_link', App::getCoreExhibitionID())['url'], 'ticket_url_target'=>App::get_field('exhibition_ticket_button_link', App::getCoreExhibitionID())['target'], 'ticket_url_title'=>App::get_field('exhibition_ticket_button_link', App::getCoreExhibitionID())['title'], 'ticket_url_text'=>App::get_field('exhibition_ticket_button_text',App::getCoreExhibitionID())])

	</div>
@endif
<div class="page-with-sidenav">
	@include('partials.content-side-navigation-core')
	<div class="page-content">
		@if (App::pageSubHeader())
			<h2 class="page-subheader">
				{{App::pageSubHeader()}}
			</h2>
		@endif
		@include('partials.content-share')
		<h2>{!! App\title() !!}</h2>
		@if (App::get_field('select_template_type') == 1)
			{{-- This is blog listing --}}
			@php(the_content())
			<div class="listing-wrapper row">
				
				@if($blogs)
					@foreach ($blogs as $blog_post)
						<article @php(post_class())>
							@include('partials.content-blog-card', ['item_id'=>$blog_post->ID])
						</article>
					@endforeach
				@else
					<div style="margin-bottom: 100px;" class="col-12">
						<div class="alert alert-warning">
							@php _e("There are no blog entries to display","sage"); @endphp
						</div>
						{!! get_search_form(false) !!}
					</div>
				@endif
			</div>
			@if ($get_max_num_pages)
				@include('partials.pagination',['max_num_pages'=>$get_max_num_pages])
			@endif


		@elseif (App::get_field('select_template_type') == 2)
			{{-- This is press listing --}}
			@if($auschwitz_press && $get_filter !='madrid_press')
				<h3>@php _e("Recent Press Coverage","sage"); @endphp</h3>
				<div class="press-card-listing auschwitz-listing">
					@foreach ($auschwitz_press as $press_item)
						@include('partials.content-press-card',['item_id'=>$press_item->ID])
					@endforeach
				</div>
				@if($get_filter)
					@if ($get_press_max_pages)
						@include('partials.pagination',['max_num_pages'=>$get_press_max_pages])
					@endif
				@else
					<div class="see-all">
						<a href="?filter=auschwitz_press" class="cta-round cta-arrow cta-secondary">@php _e("See All Press Coverage","sage"); @endphp</a>
					</div>
				@endif
				

			@endif
			@if($madrid_press && $get_filter !='auschwitz_press')
				<h3>@php _e("Exhibition Coverage from Madrid","sage"); @endphp</h3>
				<div class="press-card-listing auschwitz-listing">
					@foreach ($madrid_press as $press_item)
						@include('partials.content-press-card',['item_id'=>$press_item->ID])
					@endforeach
				</div>
				@if($get_filter)
					@if ($get_madrid_press_max_pages)
						@include('partials.pagination',['max_num_pages'=>$get_madrid_press_max_pages])
					@endif
				@else
					<div class="see-all">
						<a href="?filter=madrid_press" class="cta-round cta-arrow cta-secondary">@php _e("See All Press Coverage","sage"); @endphp</a>
					</div>
				@endif
			@endif
		@else 
			@php(the_content())
			@include('partials.content-gallery')
			@include('partials.content-related-links')
		@endif
	</div>
</div>


{!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}