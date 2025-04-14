<?php
  // Start/resume the session
  session_start();

  $logged_in = $_SESSION[ 'logged_in' ] ?? false;
  $fullname=$_SESSION['fullname'] ?? false;
  $id=$_SESSION['id'] ?? false;
  
  function login ($member) {
    session_regenerate_id( true );
    // Set the value of `logged_in` to `true` in the session
    $_SESSION[ 'logged_in' ] = true;
    $_SESSION['fullname']=$member['fullname'];
    $_SESSION['user_id']=$member['user_id'];
  }

  function logout () {
    // Clear the contents of the session superglobal array
    $_SESSION = [];

    $params = session_get_cookie_params();

    setcookie(
      'PHPSESSID',
      '', // What value do you need to set the session cookie to delete the session ID?
      time() - ( 60 * 60 * 2 ), // Set cookie expiration to 2 hours in the past
      $params[ 'path'     ],
      $params[ 'domain'   ],
      $params[ 'secure'   ],
      $params[ 'httponly' ] // Use the httponly cookie parameter
    );

    session_destroy();
  }
  function require_login ( $logged_in ) {
    if ( $logged_in == false ) {
      header( 'Location: login.php' );
      exit;
    }
  }
?>