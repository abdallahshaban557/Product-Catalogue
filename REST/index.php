<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//Needed to start the actual SLIM development
require '../vendor/autoload.php';
require '../Packages_pages/packages.Class.php';



//Always need to create an instance of this
$app = new \Slim\App;


//route for deleting a unit
$app->get("/delete-unites/{Total_Units_ID}", function(Request $request, Response $response){
    $Total_Units_ID = $request->getAttribute('Total_Units_ID');
    include_once '../Packages_pages/InitiateClass.php';
    
    //actually calls the removal method for the units
    if($packages->delete_units($Total_Units_ID))
    {
        
        return "1";
    }
    
});//end post request for deleting units



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