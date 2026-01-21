<?php
/*
Title: Claims
Post Type: products
*/

piklist('field', array(
  'type' => 'checkbox'
  ,'scope' => 'taxonomy'
  ,'field' => 'claim'
  ,'label' => 'Claims'
  ,'description' => 'Terms will appear when they are added to this taxonomy.'
  ,'choices' => array(
      
    )
    + piklist(get_terms('claim', array(
      'hide_empty' => false
    ))
    ,array(
      'term_id'
      ,'name'
    )
  )
));
?>