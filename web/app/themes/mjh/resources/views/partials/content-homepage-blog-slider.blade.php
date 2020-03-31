
<div class="row">
	<div class="col-md-12" style="text-align: center;">
		<div class="header">{{App::get_field('blog_feature_title')}}</div>
		<a href="/blog/">{!! _e("See all &#8594;","sage") !!}</a>
	</div>
</div>
<div class="featured-carousel row"> 
	<div class="col-12 wrapper">
		<div class="blog slider-posts mjh-slider">
			@foreach ($blog_posts as $blog_post)
				@include('partials.content-blog-press-slideshow', ['item_id'=>$blog_post->ID,'post_type_title'=>__("","sage")])
			@endforeach
		</div>
	</div>
</div>