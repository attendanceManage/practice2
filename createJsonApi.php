<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods:POST');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Access-Control-Allow-Methods,Authorization,X-Requested-With');

require_once 'autoload.php';

$contentType = $_SERVER['CONTENT_TYPE'];
if($contentType!='application/json')
{
    header($_SERVER['CONTENT_TYPE'].' 500 Internal Server Error');
    exit();
}

$content= trim(file_get_contents("php://input"));
$data =  json_decode($content,true);

$errorMessage = [];
$successMessage = [];


$input['response'] = [];
$input['response']['code'] = [];
$error['error']['message'] = [];  

if(isset($data['a']))
{
    $integer = preg_match("/^[0-9]*$/", $data['a']);

    if (!$integer) 
    {
      $errorMessage[] = "Input must be an integer!";
      array_push($error['error']['message'], $errorMessage);
      echo json_encode($error);

    }else{
        if($data['a'] == 1)
        {
            $randomNumberArray = range(0,100);
            shuffle($randomNumberArray);
            $randomNumberArray= array_slice($randomNumberArray,0,10);
            $input['response']['code'] = 200;
            $input['response']['message'] = 'random number generate successfully!';
            array_push($input['response']['data'], $randomNumberArray);
            echo json_encode($input);
        }
        
        if($data['a'] > 1)
        {
            $input['response']['code'] = 200;
            $input['response']['message'] =  "Ok!";
            echo json_encode($input);
        }
    
        if($data['a'] <= 0)
        {
            $input['response']['code'] = 200;
            $input['response']['message'] =  "KO!";
            echo json_encode($input);
        }
    }
}




