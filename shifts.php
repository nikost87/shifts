<?php
require('src/shiftplanning.php');
/* set the developer key on class initialization */
$shiftplanning = new shiftplanning(array(
    'key' => '5158df91ffb889e557384ec8094ec3f680a7e976'
));
// check for a current active session
$session = $shiftplanning->getSession();
//echo "appKey: " . $shiftplanning->getAppKey() . "<br/>";
//echo "appToken: " . $shiftplanning->getAppToken() . "<br/>";
if (!$session) { // if a session hasn't been started, create one
    $response = $shiftplanning->doLogin(array(
        'username' => 'nikost87@gmail.com',
        'password' => 'hemijskaolovka'
    ));
    if ($response['status']['code'] == 1) { // check to make sure that login was successful
        $session = $shiftplanning->getSession(); // return the session data after successful login
        echo "Hi, " . $session['employee']['name'];
        
    } else { // display the login error to the user
        echo $response['status']['text'] . "--" . $response['status']['error'];
    }
} else { // session has been established
    // the $session variable now holds the currently logged in user's data
    echo "Hi, " . $session['employee']['name'];
    // perform single API call in one request
    $response = $shiftplanning->setRequest(array(
        'module' => 'schedule.shifts',
        'start_date' => 'today',
        'end_date' => 'today',
        'mode' => 'overview'
    ));
}