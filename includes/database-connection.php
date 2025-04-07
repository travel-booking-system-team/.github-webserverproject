<?php
  $type     = 'mysql';     // Type of database
  $server   = 'localhost'; // Server the database is on
  $db       = 'dw3';       // Name of the database
  $port     = '3306';      // Port is usually 8889 in MAMP and 3306 in XAMPP
  $charset  = 'utf8mb4';   // UTF-8 encoding using 4 bytes of data per character

  $username = ''; // Enter YOUR username here
  $password = ''; // Enter YOUR password here

  // Options for how PDO works
  // See: https://www.php.net/manual/en/pdo.constants.php
  //
  // PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  //   Throw a PDOException if an error occurs
  //
  // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  //   Specifies that the fetch method shall return each row as an array
  //   indexed by column name as returned in the corresponding result set.
  //
  // PDO::ATTR_EMULATE_PREPARES => false
  //   Ensure that any integer data types in the database are returned to the
  //   PHP code as int data types (as opposed to strings).
  //
  $options  = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
  ];

  // DO NOT CHANGE ANYTHING BENEATH THIS LINE
  
  // Create DSN
  $dsn = "$type:host=$server;dbname=$db;port=$port;charset=$charset";
  
  try {                                                        // Try following code
    $pdo = new PDO( $dsn, $username, $password, $options );    // Create PDO object
  }
  catch ( PDOException $e ) {                                  // If exception thrown
    throw new PDOException( $e->getMessage(), $e->getCode() ); // Re-throw exception
  }
?>