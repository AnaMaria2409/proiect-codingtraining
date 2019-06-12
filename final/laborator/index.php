<?php
  
  $endpoint = $_SERVER['REQUEST_URI'];
  $method = $_SERVER['REQUEST_METHOD'];
  $requestHeaders = getallheaders();
  $requestBodyAsString = file_get_contents('php://input');
 
  // check which endpoint it is via Regular Expressions
  preg_match('/^\/api\/users\/(.+)$/', $endpoint, $matches);
  
  // to set Response Headers
  header('Content-type: application/json'); 
  
  // to set Response Body
print_r($requestHeaders);
  
?>