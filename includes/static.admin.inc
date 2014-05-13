<?php

/**
 * @file
 * Static administration functionality.
 */


/**
 * Static administrative configuration form.
 *
 * @ingroup forms
 */
function static_admin() {

  $form = array();

  $html_ext = variable_get('static_html_extensions', array('htm', 'html'));
  $html_ext = implode(', ', $html_ext);

  $form['static_html_extensions'] = array(
    '#type' => 'textfield',
    '#title' => 'HTML extensions',
    '#description' => t('Static scans for HTML files to find static pages. Enter the HTML extensions it should look for. Separate extensions with a comma (,).'),
    '#default_value' => $html_ext,
    '#size' => 100,
  );

  $markdown_ext = variable_get('static_markdown_extensions', array(
    'md',
    'mkdown',
    'markdown',
    'mark',
    'mdml',
    'mdown',
    'text',
    'mdtext',
    'mdtxt',
    'mdwn',
    'mkdn',
    )
  );
  $markdown_ext = implode(', ', $markdown_ext);

  $form['static_markdown_extensions'] = array(
    '#type' => 'textfield',
    '#title' => 'Markdown extensions',
    '#description' => t('Static scans for markdown files to find static pages. Enter the markdown extensions it should look for. Separate extensions with a comma (,).'),
    '#default_value' => $markdown_ext,
    '#size' => 100,
  );

  $allowed_tags = variable_get('static_allowed_tags', array('a',
    'em',
    'strong',
    'cite',
    'blockquote',
    'code',
    'ul',
    'ol',
    'li',
    'dl',
    'dt',
    'dd',
    'img',
    'h1',
    'h2',
    'h3',
    'h4',
    'h5',
    'h6',
    )
  );
  $allowed_tags = implode(', ', $allowed_tags);

  $form['static_allowed_tags'] = array(
    '#type' => 'textfield',
    '#title' => 'Allowed HTML tags',
    '#description' => t('Static filters HTML on render. Enter the HTML tags that should not be removed upon filtering. Separate tags with a comma (,).'),
    '#default_value' => $allowed_tags,
    '#size' => 100,
  );

  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Save'),
  );

  return $form;

}

/**
 * Submit handler for admin settings form.
 *
 * @see static_admin()
 *
 * @ingroup forms
 */
function static_admin_submit(&$form, &$form_state) {

  $html_ext = $markdown_ext = $allowed_tags = array();

  // Prepare the html extensions.
  $html_ext = trim($form_state['values']['static_html_extensions']);
  $html_ext = explode(',', $html_ext);
  $html_ext = array_map('trim', $html_ext);

  // Prepare the html extensions.
  $markdown_ext = trim($form_state['values']['static_markdown_extensions']);
  $markdown_ext = explode(',', $markdown_ext);
  $markdown_ext = array_map('trim', $markdown_ext);

  // Prepare the html extensions.
  $allowed_tags = trim($form_state['values']['static_allowed_tags']);
  $allowed_tags = explode(',', $allowed_tags);
  $allowed_tags = array_map('trim', $allowed_tags);

  variable_set('static_html_extensions', $html_ext);
  variable_set('static_markdown_extensions', $markdown_ext);
  variable_set('static_allowed_tags', $allowed_tags);

}
