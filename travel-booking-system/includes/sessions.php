<?php
  // Start/resume the session
  session_start();

  $logged_in = $_SESSION[ 'logged_in' ] ?? false;
  $email     = 'sally@example.com';
  $password  = 'password';
  
  function login () {
    session_regenerate_id( true );
    // Set the value of `logged_in` to `true` in the session
    $_SESSION[ 'logged_in' ] = true;
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

  // Write a function `require_login` that accepts a parameter `logged_in`
  // that indicates whether or not the user is logged in. If they are not,
  // redirect the user to the login page and stop script execution.
  //
  function require_login ( $logged_in ) {
    if ( $logged_in == false ) {
      header( 'Location: login.php' );
      exit;
    }
  }
?>