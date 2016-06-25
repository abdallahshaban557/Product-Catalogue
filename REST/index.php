<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//Needed to start the actual SLIM development
require '../vendor/autoload.php';
require '../Packages_pages/packages.Class.php';



//Always need to create an instance of this
$app = new \Slim\App;

//Test link
$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});

//Test link
$app->get('/shaban/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});


//Helper functions - might not need to use them all

//Method to display response
//function echoResponse($status_code, $response)
//{
//    //Getting app instance
//    $app = \Slim\Slim::getInstance();
// 
//    //Setting Http response code
//    $app->status($status_code);
// 
//    //setting response content type to json
//    $app->contentType('application/json');
// 
//    //displaying the response in json format
//    echo json_encode($response);
//}
 

$app->get('/unites/{Package_ID}', function (Request $request, Response $response) {
    $Package_ID = $request->getAttribute('Package_ID');
    include_once '../Packages_pages/InitiateClass.php';
    $result = $packages->unites_modal_dataview($Package_ID);
    echo json_encode($result);
});

 
$app->run();