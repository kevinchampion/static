<?php
/**
 * @file
 * Extends Parsedown class for Static specific modifications.
 */


class StaticParsedown extends Parsedown {

  public $basePath;

  /**
   * Defines the base_path for use in the reference block.
   *
   * Allows definition of specific root directories for asset paths to be found
   * in.
   *
   * @param string $path
   *   Base path of the asset root.
   */
  public function setBasePath($path) {

    $this->basePath = $path;

  }

  /**
   * Override parent reference to inject basePath.
   *
   * This allows for using the image reference convention in markdown to add
   * images whose paths will be relative to the Drupal base_path. Without this,
   * image paths are incorrect.
   *
   * @param string $line
   *   A string line as read from the source file.
   *
   * @return array
   *   A reference block.
   */
  protected function identifyReference($line) {

    if (preg_match('/^\[(.+?)\]:[ ]*<?(\S+?)>?(?:[ ]+["\'(](.+)["\')])?[ ]*$/', $line['text'], $matches)) {

      $label = strtolower($matches[1]);

      $this->references[$label] = array(
        'url' => $this->basePath . $matches[2],
      );

      if (isset($matches[3])) {
        $this->references[$label]['title'] = $matches[3];
      }

      $block = array(
        'element' => NULL,
      );

      return $block;

    }

  }

}
