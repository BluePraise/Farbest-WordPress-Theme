<?php
/*
Title: Certifications
Post Type: products
*/

piklist('field', array(
  'type' => 'checkbox'
  ,'scope' => 'taxonomy'
  ,'field' => 'certification'
  ,'label' => 'Certifications'
  ,'description' => 'Terms will appear when they are added to this taxonomy.'
  ,'choices' => array(
      
    )
    + piklist(get_terms('certification', array(
      'hide_empty' => false
    ))
    ,array(
      'term_id'
      ,'name'
    )
  )
));
?>