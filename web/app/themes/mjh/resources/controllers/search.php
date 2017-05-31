<?php

namespace App;

use Sober\Controller\Controller;
use WP_Query;

class Search extends Controller
{
    /**
     * Return number of search results
     *
     * @return int
     */
    public static function resultsFound()
    {
        global $wp_query;
        return $wp_query->found_posts;
    }


}
