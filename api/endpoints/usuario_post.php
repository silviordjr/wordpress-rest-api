<?php

function api_usuario_post($request){

    $email = sanitize_email($request['email']);
    $nome = sanitize_text_field($request['nome']);
    $senha = sanitize_text_field($request['senha']);
    $cpf = sanitize_text_field($request['cpf']);

    $user_exists = username_exists($email);
    $email_exists = email_exists($email);

    if ($email && $nome && $senha && !$user_exists && !$email_exists){
        $user_id = wp_create_user($email, $senha, $email);
        wp_update_user(array(
            'ID' => $user_id,
            'display_name' => $nome
        ));

        if ($cpf){
            update_user_meta($user_is, 'cpf', $cpf);
        }

        $response = array(
            'message' => 'Usuário Criado!'
        );
    } else {
        $response = new WP_Error('email', 'verifique preenchimento dos dados', array('status' => 403));
    }
    
    return rest_ensure_response($response);
}

function registrar_api_usuario_post(){
    register_rest_route('api', '/usuario', array(
        array(
            'methods' => WP_REST_Server::CREATABLE,
            'callback' => 'api_usuario_post'
        ),
    ));
}

add_action('rest_api_init', 'registrar_api_usuario_post');

?>