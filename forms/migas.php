<?php

class Breadcrumb {
  private $breadcrumbs = array();

  public function addCrumb($label, $url = '') {
    $this->breadcrumbs[] = array('label' => $label, 'url' => $url);
  }

  public function render() {
    $output = '<div class="pagetitle">';
    $output .= '<h1>Navegacion Almacenes UTA</h1>';
    $output .= '<nav>';
    $output .= '<ol class="breadcrumb">';

    $count = count($this->breadcrumbs);
    for ($i = 0; $i < $count; $i++) {
      $breadcrumb = $this->breadcrumbs[$i];

      if ($i == $count - 1) {
        $output .= '<li class="breadcrumb-item active text-danger">' . $breadcrumb['label'] . '</li>';
      } else {
        $output .= '<li class="breadcrumb-item"><a href="' . $breadcrumb['url'] . '">' . $breadcrumb['label'] . '</a></li>';
      }
    }

    $output .= '</ol>';
    $output .= '</nav>';
    $output .= '</div>';

    echo $output;
  }
}
?>