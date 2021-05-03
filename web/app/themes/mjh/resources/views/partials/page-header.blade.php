<div class="page-header container">
  <h1>
    @if ( get_post_type() == "attachment" )
  	 {!! _e("Image archives","sage") !!}
    @elseif (App::isPageTemplate( 'views/template-core.blade.php') || App::getCoreExhibitionID() === get_the_ID())
      @if (App::get_field('highlighted_exhibition_logo',App::getCoreExhibitionID()))
        <a href="{{ get_the_permalink(App::getCoreExhibitionID()) }}"><img src="{{ App::get_field('highlighted_exhibition_logo',App::getCoreExhibitionID())['sizes']['medium'] }}" alt="{!! App::get_field('highlighted_exhibition_logo',App::getCoreExhibitionID())['alt'] !!}" class="page-header--logo"></a>
      @else
        {!! get_the_title(App::getCoreExhibitionID()) !!}
      @endif

    @else
      {!! App\title() !!}
    @endif
  </h1>
  @if(App::getCoreExhibitionID() === get_the_ID())
    
    {{-- print buy tickets button (if link added for this exhibition) --}}
    @include('partials.content-exhibition-ticket-button', ['wrapper_class'=>'highlighted_exhibition_button', 'ticket_url' => App::get_field('exhibition_ticket_button_link', App::getCoreExhibitionID())['url'], 'ticket_url_target'=>App::get_field('exhibition_ticket_button_link', App::getCoreExhibitionID())['target'], 'ticket_url_title'=>App::get_field('exhibition_ticket_button_link', App::getCoreExhibitionID())['title'], 'ticket_url_text'=>App::get_field('exhibition_ticket_button_text',App::getCoreExhibitionID())])

    <div class="highlighted_exhibition_annonce">
      <p>{!! App::get_field('exhibition_notes_announcements',App::getCoreExhibitionID()) !!}</p>
    </div>
  
  @endif
  
  @if ( !empty($post) && $post->post_type =='post' && !is_post_type_archive())
    <div class="post-meta">
      @if (App::get_field('publication_logo',$post->ID))
        <div class="publication-name">{!! get_post_meta( App::get_field('publication_logo', $post->ID ), '_wp_attachment_image_alt', true);  !!}</div>
      @endif
      @if (!in_array(get_category_by_slug('in-memoriam')->term_id, App::postCategories($post->ID)))
        <div class="post-date">@php(the_date('l, F j, Y'))</div>
      @endif
    </div>
  @endif
  @if (is_search())
     <p class="results-stats"><span class="bold">{{ Search::resultsFound() }}</span> results for &#8220; {!! get_search_query() !!} &#8221;</p>
  @endif
</div>

@if ((App::isPageTemplate( 'views/template-core.blade.php' ) || App::getCoreExhibitionID() === get_the_ID()) && (App::get_repeater_field('primary_sponsors_repeater', App::getCoreExhibitionID()) || App::get_repeater_field('secondary_sponsor_header', App::getCoreExhibitionID())))
    @include('partials.content-sponsors-switch')
@endif