<?php
  $type     = 'mysql';     
  $server   = 'localhost';  
  $db       = 'travel_bookingdb';       
  $port     = '3306';    
  $charset  = 'utf8mb4';  

  $username = 'zenha';           
  $password = 'JesusisKing7'; 

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
