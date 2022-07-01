<?php

function registrar_cpt_trasacao () {

    register_post_type('trasacao', array(
        'label' => 'trasacao',
        'description' => 'trasacao',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'rewrite' => array('slug' => 'trasacao', 'with_front' => true),
        'query_var' => true,
        'supports' => array('custom-fields', 'author', 'title'),
        'publicly_queryable' => true
    ));
}

add_action('init', 'registrar_cpt_trasacao');

?>