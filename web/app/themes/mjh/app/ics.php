<?php
if ( ! defined('ABSPATH') ) {
    /** Set up WordPress environment */
    require_once( $_SERVER['DOCUMENT_ROOT']. '/wp/wp-load.php' );
}
// Get event id
if(!empty($_REQUEST['eid']) && is_numeric($_REQUEST['eid'])){
  $post_id = ($_REQUEST['eid']);
  // Get post data
  $post = get_post($post_id);
  // Make sure post are only of type 'event'
  if($post->post_type == 'event'){
    $event_type = get_field( "event_type", $post_id );
    // Switch through the different event types for datetimes
    switch($event_type){
      case 'onetime':
        $event_start_date = get_field( "event_start_date", $post_id );
        $event_start_time = get_field( "event_start_time", $post_id );
        $event_end_date = $event_start_date;
        $event_end_time = get_field( "event_end_time", $post_id );
      break;
      case 'ongoing':
        $event_start_date = get_field( "event_start_date", $post_id );
        $event_start_time = "00:00:00";
        $event_end_date = get_field( "event_end_date", $post_id );
        $event_end_time = "23:59:59";
      break;
      case 'recurring':
        // No ICS file
        wp_redirect(home_url());
        die();
      break;
    }
    // Get location information
    $location = get_field( "event_location", $post_id ).' '.get_field( "event_street", $post_id ).' '.get_field( "event_secondary_street", $post_id ).' '.get_field( "event_city", $post_id ).' '.get_field( "event_state", $post_id ).' '.get_field( "event_zip_code", $post_id );
    // Get post url
    $url = get_permalink( $post_id);
    // Set ICS file headers
    header('Content-type: text/calendar; charset=utf-8');
    header('Content-Disposition: attachment; filename=event.ics');
    // Create ICS file data
    $ics = new ICS(array(
      'location' => $location,
      'dtstart' => $event_start_date.' '.$event_start_time,
      'dtend' => $event_end_date.' '.$event_end_time,
      'summary' => $post->post_title,
      'description' => $post->post_excerpt,
      'url' => $url
    ));
    // Trigger download of ics file
    echo $ics->to_string();
  }
}

// ICS php cLass from https://gist.github.com/635416.git
class ICS {
  const DT_FORMAT = 'Ymd\THis';

  protected $properties = array();
  private $available_properties = array(
    'description',
    'dtend',
    'dtstart',
    'location',
    'summary',
    'url'
  );

  public function __construct($props) {
    $this->set($props);
  }

  public function set($key, $val = false) {
    if (is_array($key)) {
      foreach ($key as $k => $v) {
        $this->set($k, $v);
      }
    } else {
      if (in_array($key, $this->available_properties)) {
        $this->properties[$key] = $this->sanitize_val($val, $key);
      }
    }
  }

  public function to_string() {
    $rows = $this->build_props();
    return implode("\r\n", $rows);
  }

  private function build_props() {
    // Build ICS properties - add header
    $ics_props = array(
      'BEGIN:VCALENDAR',
      'VERSION:2.0',
      'PRODID:-//Museum of Jewish Heritage/Events v1.0//EN',
      'CALSCALE:GREGORIAN',
      'METHOD:PUBLISH',
      'BEGIN:VEVENT'
    );

    // Build ICS properties - add header
    $props = array();
    foreach($this->properties as $k => $v) {
      $props[strtoupper($k . ($k === 'url' ? ';VALUE=URI' : ''))] = $v;
    }

    // Set some default values
    $props['DTSTAMP'] = $this->format_timestamp('now');
    $props['UID'] = uniqid();

    // Append properties
    foreach ($props as $k => $v) {
      $ics_props[] = "$k:$v";
    }

    // Build ICS properties - add footer
    $ics_props[] = 'END:VEVENT';
    $ics_props[] = 'END:VCALENDAR';

    return $ics_props;
  }

  private function sanitize_val($val, $key = false) {
    switch($key) {
      case 'dtend':
      case 'dtstamp':
      case 'dtstart':
        $val = $this->format_timestamp($val);
        break;
      default:
        $val = $this->escape_string($val);
    }

    return $val;
  }

  private function format_timestamp($timestamp) {
    $dt = new DateTime($timestamp);
    return $dt->format(self::DT_FORMAT);
  }

  private function escape_string($str) {
    return preg_replace('/([\,;])/','\\\$1', $str);
  }
}