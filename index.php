<?php

$method = $_SERVER['REQUEST_METHOD'];

// Proceeds only when method is POST
if($method == "POST") {
    $requestBody = file_get_contents('php://input');
    $json = json_decode($requestBody);
    
//     $requestName = file_get_contents("https://graph.facebook.com/v2.6/<PSID>?fields=first_name,last_name,profile_pic&access_token=<PAGE_ACCESS_TOKEN>";
//     $name = json_decode($requestName);

    $text = $json->result->parameters->text;
//     $username = $name->result->parameters->first_name;

    switch ($text) {
      case 'hi':
        $speech = "Hi! Let's not be so informal.";
        break;

      case 'hello':
        $speech = "Hello! We don't have to be so formal.";
        break;

      default:
        $speech = "This is what you said: " . $text;
        break;
    }

    $response = new \stdClass();
    $response->speech = $speech;
    $response->displayText = "";
    $response->source = "webhook";
    echo json_encode($response);
}
else {
  echo "Method not allowed";
}

?>
