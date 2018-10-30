<?php

/* Helper function for showing Bootstrap 4 alert with laravel flash session, or just fetching the alert HTML */

if (!function_exists('show_alert')) {
  function show_alert($type='success', $header='', $message='', $footer='', $return_html=FALSE) 
  { 
    if($type) {
      // available type for Bootstrap 4 alert: primary, secondary, success, danger, warning, info, light, & dark

      $type = strtolower($type);
      
      //Setting bootstrap Alert HTML 
      if($header) { $header = '<h4 class="alert-heading">'.$header.'</h4>'; }
      if($footer) { $footer = '<hr> <p class="mb-0">'.$footer.'</p>'; }
      $html = '<div class="alert alert-'.$type.' alert-dismissible fade show" role="alert">'
              .$header
              .'<div>'.$message.'</div>'
              .'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>'
              .$footer
            .'</div>';

      if($return_html) {
        return $html;
      }
      else {
        session()->flash("alert_msg", $html);
        return TRUE;
      }

    }
    else {
      return FALSE;
    }

  }
}
