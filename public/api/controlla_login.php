<?php

// CONTROLLO CHE SIA UNA CHIAMATA AJAX *******************************************
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{ 


require_once('../../app/class/class_login.php'); 
$email = filter_input(INPUT_POST, 'indirizzo_email', FILTER_SANITIZE_EMAIL );
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING );


if ($email && $password) {
    
    $login = new Login;
    $controllo_login = $login->controllo($email, $password);
    
    
    if ($controllo_login) {
        
        $content[] = $controllo_login;
        
         echo json_encode($content);
    }
} // END IF EMAIL E PASSWORD

} // END CHIAMATA AJAX

