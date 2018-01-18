<?php
class block_simplehtml extends block_base {
    public function init() {
        $this->title = get_string('simplehtml', 'block_simplehtml');
    }

  public function get_content() {
      if ($this->content !== null) {
        return $this->content;
      }

      if (! empty($this->config->text)) {
    $this->content->text = $this->config->text;
}

  global $COURSE;

  // The other code.

  $url = new moodle_url('/blocks/simplehtml/view.php', array('blockid' => $this->instance->id, 'courseid' => $COURSE->id));
  $this->content->footer = html_writer::link($url, get_string('addpage', 'block_simplehtml'));;

      return $this->content;
  }

  public function specialization() {
    if (isset($this->config)) {
        if (empty($this->config->title)) {
            $this->title = get_string('defaulttitle', 'block_simplehtml');
        } else {
            $this->title = $this->config->title;
        }

        if (empty($this->config->text)) {
            $this->config->text = get_string('defaulttext', 'block_simplehtml');
        }
    }
}
  public function instance_allow_multiple() {
  return true;
  }

  function has_config() {return true;}

  public function instance_config_save($data,$nolongerused =false) {
    if(get_config('simplehtml', 'Allow_HTML') == '0') {
      $data->text = strip_tags($data->text);
    }

    // And now forward to the default implementation defined in the parent class
    return parent::instance_config_save($data,$nolongerused);
  }

  // If this function is set to return true then the header will be hidden
  public function hide_header() {
  return false;
}

public function applicable_formats() {
  return array(
           'site-index' => true,
          'course-view' => true,
   'course-view-social' => false,
                  'mod' => true,
             'mod-quiz' => false
  );
}
}
