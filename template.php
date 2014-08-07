<?php

/**
 * @file
 * Template overrides as well as (pre-)process and alter hooks for the
 * inkshop theme.
 */

function inkshop_theme_form_alter(&$form, &$form_state, $form_id) {
  switch($form_id) {
    case 'commerce_checkout_form_checkout' :
      $form['checkout_donate']['checkout_donate']['commerce_donate_amount']['und']['#options'] = array(
        '0' => 'Keine',
	'1' => '1€',
        '5' => '5€',
        '10' => '10€',
        '20' => '20€',
      );
      $form['checkout_donate']['checkout_donate']['commerce_donate_amount']['und']['#default_value'] = '0';
    break;
  }
}

function inkshop_theme_entity_property_info_alter(&$info){
  $info['node']['properties']['sort_price'] = array(
     'type' => 'decimal',
     'label' => 'Sort price',
     'description' => 'The price to sort this product by.',
     'getter callback' => '_inkshop_theme_get_sort_price',
  );
}
/*
* getter callback for sort price property
*
* return the lowest product price associated with this display
*
*/
function _inkshop_theme_get_sort_price($data, array $options, $name, $type, $info){
  if($name == 'sort_price'){
    $wrapper = entity_metadata_wrapper('node', $data);
    //check if this is a product display
    if(array_key_exists('field_product', $wrapper->getPropertyInfo())){
      $prices = array();
      //loop trough referenced products
      foreach ($wrapper->field_product->getIterator() as $delta => $term_wrapper) {
        //get value of commerce_price
        $price_field = $term_wrapper->commerce_price->value();
        //transform commerce price to decimal
        $prices[] = commerce_currency_amount_to_decimal($price_field['amount']);
      }
      //return lowest price for this display
      return min($prices);
    }
  }
  return NULL;
}

function inkshop_theme_follow_link($variables) {
  $link = $variables['link'];
  $title = $variables['title'];
  $classes = array();
  $classes[] = 'follow-link';
  $classes[] = "follow-link-{$link->name}";
  $classes[] = $link->uid ? 'follow-link-user' : 'follow-link-site';
  $attributes = array(
    'class' => $classes,
    'title' => follow_link_title($link->uid) .' '. $title,
    /* The following line is the only line added/different from the stock function defined with 'follow' */
    /*'data-popup' => 'true',*/
    'target' => '_blank',
  );
  $link->options['attributes'] = $attributes;
  return l($title, $link->path, $link->options) . "\n";
}

function inkshop_theme_preprocess_commerce_checkout_review(&$variables) {
  $panes = array();
  foreach ($variables['form']['#data'] as $pane_id => $data) {
    $panes[$pane_id] = array(
      'title' => $data['title'],
      'data' => $data['data'],
    );
  }
  $variables['panes'] = $panes;
}
?>