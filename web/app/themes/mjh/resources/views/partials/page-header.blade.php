<div class="page-header">
  <h1>{!! App\title() !!}</h1>
  @if (is_search())
     <p class="results-stats"><span>{{ Search::resultsFound() }}</span> results for &#8220; {!! get_search_query() !!} &#8221;</p>
  @endif
</div>