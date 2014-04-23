<?php

/**
 * @file
 * Documentation of Static hooks.
 */


/**
 * Hook to declare static site. Modules wanting to generate static sites must
 * implement this hook and pass information about the site so that Static can
 * build out the menu system.
 *
 * @param $sites
 *   Associative array of sites info. For Static to render sites, the site info
 *   must be explicitly returned using this hook.
 *
 *   'directory' (required)
 *     The root directory of the site files.
 *   'root_path' (required)
 *     The url path to the root of the site.
 *   'title' (required)
 *     The title of the site.
 *   'assets_directory' (optional)
 *     The root directory of the site's assets (images, css, js).
 *   'markdown_library' (optional)
 *     The library to use for converting markdown. Takes options 'parsedown' or
 *     'php-markdown'. Defaults to 'parsedown'.
 *   'html_extensions' (optional)
 *     Array of html extensions Static should build menu items and render for
 *     this site.
 *   'markdown_extensions' (optional)
 *     Array of markdown extensions Static should build menu items and render
 *     for this site.
 *   'allowed_tags' (optional)
 *     Array of HTML tags that should not be filtered out when filtering
 *     rendered HTML for security purposes. This array is passed to
 *     filter_xss().
 *     @see filter_xss()
 *   'access' (optional)
 *     The user permission that will control access to the entire site.
 *   'weight' (optional)
 *     The menu item weight of the root of the site.
 *   'pages' (optional)
 *     Array of individual pages, each of which is an associative array of
 *     properties. Supported properties map to menu item properties and
 *     include 'title', 'access arguments', and 'type'.
 */
function hook_static_sites_info_alter(&$sites) {

  $my_module_path = drupal_get_path('module', 'my_site');

  $sites['my_site'] = array(
    'directory' => $my_module_path . '/docs',
    'root_path' => 'my-site',
    'assets_directory' => $my_module_path . '/docs/assets',
    'markdown_library' => 'parsedown',
    'html_extensions' => array('htm', 'html'),
    'markdown_extensions' => array('md', 'mkdown', 'markdown', 'mark', 'mdml', 'mdown', 'text', 'mdtext', 'mdtxt', 'mdwn', 'mkdn'),
    'allowed_tags' => array('a', 'em', 'strong', 'cite', 'blockquote', 'code', 'pre', 'ul', 'ol', 'li', 'dl', 'dt', 'dd', 'img', 'p', 'br', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'),
    'title' => 'Dynamic static site test',
    'description' => 'My site\'s description.',
    'access' => 'view my site',
    'weight' => 100,
    'pages' => array(
      'subdir' => array(
        'title' => 'My subdirectory',
        'description' => 'My subdirectory defines hierarchical structure to my-site. It has it\'s own menu item and renders a dynamic index page listing the pages within it. Adding a static index file within my subdirectory will render that static page in place of the dynamic index output.',
      ),
      'subdir/index.md' => array(
        'title' => 'Home',
        'description' => 'My page\'s description.',
        'access arguments' => array('view my-site'),
        'type' => MENU_NORMAL_ITEM,
      ),
    ),
  );

}

/**
 * Hook to allow modules to alter the render output after the file contents
 * have been retrieved and filtered in preparation for output.
 *
 * @param $content
 *   Content of the file as retrieved from file_get_contents().
 * @param $context
 *   Associative array containing the site id, file path, and SplFileInfo file
 *   object of the file.
 *   array(
 *     'site_id' => 'my_site',
 *     'file_path' => '/path/to/my/file',
 *     'file' => SplFileInfo object,
 *   );
 */
function hook_static_pre_render_alter(&$content, $context) {



}

/**
 * Hook to allow modules to alter the render output after the file contents
 * have been retrieved and filtered in preparation for output.
 *
 * @param $filtered_html
 *   Already filtered HTML ready for output to the page.
 * @param $context
 *   Associative array containing the site id, file path, and SplFileInfo file
 *   object of the file.
 *   array(
 *     'site_id' => 'my_site',
 *     'file_path' => '/path/to/my/file',
 *     'file' => SplFileInfo object,
 *   );
 */
function hook_static_post_render_alter(&$filtered_html, $context) {



}
