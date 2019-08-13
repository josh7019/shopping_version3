<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '\shopping\model\all.php');

    $url_list = explode('/' , $_SERVER['REQUEST_URI']);
    $action = (isset($url_list[4])) ? $url_list[4] : '';
    $get_list = explode('?',$action);
    $action = $get_list[0];
    $query_string = (isset($get_list[1])) ? $get_list[1] : '';;
    $id = (isset($url_list[5])) ? $url_list[5] : '';
    $method = $_SERVER['REQUEST_METHOD'];
    $method_action = "{$method}_{$action}";
    new UserController($method_action, $id, $query_string);
