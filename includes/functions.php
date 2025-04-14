<?php

function pdo ( PDO $pdo, string $sql, array $arguments = null ) {
  if ( ! $arguments ) {               // If no arguments
    return $pdo->query( $sql );       // Run SQL and return PDOStatement object
  }
  $statement = $pdo->prepare( $sql ); // If arguments prepare statement
  $statement->execute( $arguments );  // Execute statement
  return $statement;                  // Return PDOStatement object
}

?>