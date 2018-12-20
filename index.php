<?php
/**
 * Controller
 * User: b.kleppe, l.janssen, t.tan, g.danoe
 * Date: 05-11-18
 * Time: 15:25
 */

include 'model.php';

/* Connect to DB */
$db = connect_db('localhost', 'ddwt_project', 'ddwt18','ddwt18');

$template = Array(
    1 => Array(
        'name' => 'Home',
        'url' => '/DDWT18/ddwt18_project/'),
    2 => Array(
        'name' => 'Overview',
        'url' => '/DDWT18/ddwt18_project/overview/'),
    3 => Array(
        'name' => 'Add room',
        'url' => '/DDWT18/ddwt18_project/add/'),
    4 => Array(
        'name' => 'My Account',
        'url' => '/DDWT18/ddwt18_project/myaccount/'),
    5 => Array(
        'name' => 'Register',
        'url' => '/DDWT18/ddwt18_project/register/')
);

/* Overview page */
if (new_route('/DDWT18/ddwt18_project/overview/', 'get')) {
    /* Page info */
    $page_title = 'Overview';
    $navigation = get_navigation($template, '2');

    /* Page content */
    $page_subtitle = 'The overview of all rooms available';
    $page_content = 'On this page you will find all available rooms for internationals.';
    $left_content = get_room_table(get_rooms($db), $db);

    /* Get Number of rooms and users */
    $nbr_rooms = count_rooms($db);
    $nbr_users = count_users($db);
    /* always use template 'cards' */
    $right_column = use_template('cards');

    /* Get error msg from POST route */
    if ( isset($_GET['error_msg']) ) {
        $error_msg = get_error($_GET['error_msg']);
    }

    /* Choose Template */
    include use_template('main');
}

/* Add serie get */
elseif (new_route('/DDWT18/ddwt18_project/add/', 'get')) {
    /* Check if logged in */

    /* Page info */
    $page_title = 'Add Room';
    $navigation = get_navigation($template, '3');

    /* Page content */
    $page_subtitle = 'Search a new roommate';
    $page_content = 'Fill in the details of your room.';
    $submit_btn = "Add room";
    $form_action = '/DDWT18/ddwt18_project/add/';

    /* Get error msg from POST route */
    if ( isset($_GET['error_msg']) ) {
        $error_msg = get_error($_GET['error_msg']);
    }

    include use_template('new');
}

/* Add serie POST */
elseif (new_route('/DDWT18/ddwt18_project/add/', 'post')) {
    /* Check if logged in */

    /* Add room to database */
    $feedback = add_room($db, $_POST);
    /* Redirect to room GET route */
    redirect(sprintf('/DDWT18/ddwt18_project/add/?error_msg=%s',
        json_encode($feedback)));
}

/* Single Serie */
elseif (new_route('/DDWT18/ddwt18_project/room/', 'get')) {
    /* Get series from db */
    $room_id = $_GET['room_id'];
    $user_name = get_name($db, $room_id);
    $room_info = get_room_info($db, $room_id);
    $display_buttons = get_user_id() == $room_info['room_id'];

    /* Page info */
    $page_title = sprintf("%s %s", $room_info['street'], $room_info['house_number']);
    $navigation = get_navigation($template, '2');

    /* Page content */

    $added_by = $user_name['firstname']." ".$user_name['lastname'];
    $page_subtitle = sprintf("Information about %s %s", $room_info['street'], $room_info['house_number']);
    $description = $room_info['description'];
    $type = $room_info['type'];
    $size = $room_info['size'];
    $price = $room_info['price'];
    $tenant = $room_info['tenant'];
    $address = sprintf("%s %s", $room_info['postal_code'], $room_info['city']);
    $birthdate = $user_name['dateofbirth'];
    $language = $user_name['language'];
    $phonenumber = $user_name['phone_number'];
    $email = $user_name['email'];
    $address_variable = sprintf("%s %s", $room_info['street'], $room_info['house_number']);;

    /* always use template 'cards' */
    $right_column = use_template('owner_card');

    /* Get error msg from POST route */
    if ( isset($_GET['error_msg']) ) { $error_msg = get_error($_GET['error_msg']); }

    /* Choose Template */
    include use_template('room');
}

/* Register GET */
elseif (new_route('/DDWT18/ddwt18_project/register/', 'get')){
    /* Page info */
    $page_title = 'Register';
    $navigation = get_navigation($template, 5);
    /* Page content */
    $page_subtitle = 'Register here to add rooms or to opt-in for a room';
    /* Get error msg from POST route */
    if ( isset($_GET['error_msg']) ) { $error_msg = get_error($_GET['error_msg']); }
    /* Choose Template */
    include use_template('register');
}

/* Register POST */
elseif (new_route('/DDWT18/ddwt18_project/register/', 'post')){
    /* Register user */
    $feedback = register_user($db, $_POST)
        /* Redirect to homepage */;
    redirect(sprintf('/DDWT18/ddwt18_project/register/?error_msg=%s',
        json_encode($feedback)));
}



/*
else {
    http_response_code(404);
}
*/




