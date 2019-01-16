<div class="page-header container">
  <h1>
    @if ( get_post_type() == "attachment" )
  	 {!! _e("Image archives","sage") !!}
    @elseif (App::isPageTemplate( 'views/template-core.blade.php') || App::getCoreExhibitionID() === get_the_ID())
      @if (App::get_field('highlighted_exhibition_logo','option'))
        <a href="{{ get_the_permalink(App::getCoreExhibitionID()) }}"><img src="{{ App::get_field('highlighted_exhibition_logo','option')['url'] }}" alt="{!! App::get_field('highlighted_exhibition_logo','option')['alt'] !!}" class="page-header--logo"></a>
      @else
        {!! get_the_title(App::getCoreExhibitionID()) !!}
      @endif

    @else
      {!! App\title() !!}
    @endif
  </h1>
  @if(App::getCoreExhibitionID() === get_the_ID())
    <a href="{{App::get_field('exhibition_ticket_button_link',get_the_ID())['url']}}" @if(App::get_field('exhibition_ticket_button_link',get_the_ID())['target']) target="{{ App::get_field('exhibition_ticket_button_link',get_the_ID())['target'] }}"@endif @if(App::get_field('exhibition_ticket_button_link',get_the_ID())['title']) title="{{ App::get_field('exhibition_ticket_button_link',get_the_ID())['title'] }}"@endif class="cta-round cta-secondary" style="margin: 25px 0;">{{App::get_field('exhibition_ticket_button_text',get_the_ID())}}</a>
  @endif
  @if ( !empty($post) && $post->post_type =='post' && !is_post_type_archive())
    <div class="post-meta">
      @if (App::get_field('publication_logo',$post->ID))
        <div class="publication-name">{!! get_post_meta( App::get_field('publication_logo', $post->ID ), '_wp_attachment_image_alt', true);  !!}</div>
      @endif
      <div class="post-date">@php(the_date('l, F j, Y'))</div>
    </div>
  @endif
  @if (is_search())
     <p class="results-stats"><span class="bold">{{ Search::resultsFound() }}</span> results for &#8220; {!! get_search_query() !!} &#8221;</p>
  @endif
</div>

@if ((App::isPageTemplate( 'views/template-core.blade.php' ) || App::getCoreExhibitionID() === get_the_ID()) && (App::get_repeater_field('primary_sponsors_repeater', App::getCoreExhibitionID()) || App::get_repeater_field('secondary_sponsor_header', App::getCoreExhibitionID())))
    <div class="content-sponsors inheader">

      @if (App::get_repeater_field('primary_sponsors_repeater', App::getCoreExhibitionID()))
        <!-- Primary sponsors -->
        @include('partials.content-sponsors', ['sectionTitle' => App::get_field('primary_sponsor_header', App::getCoreExhibitionID()),'sectionClass'=>"exhibition",'sectionType'=>"primary",'exhibitID'=>App::getCoreExhibitionID()])
      @endif

      @if (App::get_repeater_field('secondary_sponsors_repeater', App::getCoreExhibitionID()))
        <!-- Secondary sponsors -->
        @include('partials.content-sponsors', ['sectionTitle' => App::get_field('secondary_sponsor_header', App::getCoreExhibitionID()),'sectionClass'=>"exhibition",'sectionType'=>"secondary", 'exhibitID'=>App::getCoreExhibitionID()])
      @endif
    </div>
@endif