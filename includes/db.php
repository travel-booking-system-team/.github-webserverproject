<?php
  $type     = 'mysql';     
  $server   = 'localhost';  
  $db       = 'travelbookingdb';       
  $port     = '3308';    
  $charset  = 'utf8mb4';  

  $username = 'jessicanahat';           
  $password = 'phpclass2025'; 

  $options  = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
  ];

  $dsn = "$type:host=$server;dbname=$db;port=$port;charset=$charset";
  
  try {                                                        // Try following code
    $pdo = new PDO( $dsn, $username, $password, $options );    // Create PDO object
  }
  catch ( PDOException $e ) {                                  // If exception thrown
    throw new PDOException( $e->getMessage(), $e->getCode() ); // Re-throw exception
  }
?>
