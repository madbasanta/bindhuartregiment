<?php

function authenticated()
{
    if(!auth()) {
        http_response_code(401);
        header('Location: /admin/login');
        exit;
    }
}

function formdata_content()
{
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        // Handle the POST data
        $postData = json_decode(file_get_contents('php://input'), true); // Get JSON data as an associative array
        $_POST = $postData;
    }
}

function validate($bag, $messages = [])
{
    $error_bag = [];
    foreach($bag as $field => $rules) {
        $rules = explode('|', $rules);
        foreach($rules as $rule) {
            if(!validate_rule($field, $rule)) {
                $error_bag[$field] = "The {$field} field is invalid";
                if(isset($messages[$rule])) {
                    $error_bag[$field] = str_replace('{$field}', $field, $messages[$rule]);
                }
            }
        }
    }
    if(count($error_bag) > 0) {
        $_SESSION['post_old'] = $_POST;
        http_response_code(422);
        // check if ajax
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            header('Content-Type: application/json');
            echo json_encode([
                'message' => 'Validation failed',
                'errors' => $error_bag
            ]);
        } else {
            // redirect back
            $_SESSION['post_errors'] = $error_bag;
            header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/admin'));
        }
        exit;
    }
}

function validate_rule($field, $rule)
{
    switch($rule) {
        case 'required':
            $trimmedString = trim(strip_tags(str_replace("\n", "", $_POST[$field] ?? $_GET[$field] ?? '')));
            return !empty($trimmedString);
            break;
        case 'unique':

    }
}