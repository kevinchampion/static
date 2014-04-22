<?php
/**
 * @file
 */


class StaticParsedown extends Parsedown {

  var $base_path;

  /**
   * Defines the base_path for use in
   */
  function set_base_path($path) {

    $this->base_path = $path;

  }

  /**
   * Override parent reference to inject base_path.
   * @param [type] $Line [description]
   * @return [type]
   */
  protected function identifyReference($Line) {

    if (preg_match('/^\[(.+?)\]:[ ]*<?(\S+?)>?(?:[ ]+["\'(](.+)["\')])?[ ]*$/', $Line['text'], $matches)) {

      $label = strtolower($matches[1]);

      $this->references[$label] = array(
        'url' => $this->base_path . $matches[2],
      );

      if (isset($matches[3])) {
        $this->references[$label]['title'] = $matches[3];
      }

      $Block = array(
        'element' => null,
      );

      return $Block;

    }

  }

}
