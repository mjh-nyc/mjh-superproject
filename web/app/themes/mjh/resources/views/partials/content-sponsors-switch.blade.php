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
