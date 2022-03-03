<?php
require_once __DIR__ . '/query-builder/Query.php';
require_once __DIR__ . '/functions.php';

$request_type = handle_request();

$params = explode('/', $_SERVER['REQUEST_URI']);
$resource = @$params[count(@$params) - 2];
$id = @$params[count(@$params) - 1];

switch ($request_type):
     case 'GET':
          process_get($id);
          break;
     case 'POST':
          process_post();
          break;
     case 'PUT':
          process_put($id);
          break;
     case 'PATCH':
          process_patch();
          break;
     case 'DELETE':
          process_delete($id);
          break;
     default:
          die('Invalid Request');
          break;
endswitch;

function process_get($id = '')
{

     global $resource;
     $query = new Query();

     if ($id == '') {
          $records = $query->select('*')->table($resource)->allRecords();
     }

     if ($id) {
          $records = $query->select('*')->table($resource)->where('id', $id)->first();
     }

     if ($records == false) {

          $response = array(
               'code' => 201,
               'status' => false,
               'message' => 'Record Not Found for ' . $resource,
               'data' => [],
          );
     } else {

          $response = array(
               'code' => 200,
               'status' => true,
               'message' => 'Record Found',
               'data' => $records,
          );
     }

     header("Content-Type:application/json");
     http_response_code(200);
     echo json_encode($response, JSON_PRETTY_PRINT);
     exit();
}


function process_post()
{
     global $resource;

     $formdata = $_REQUEST;
     if (isset($formdata)) {
          $query = new Query();

          try {
               if ($query->insert($resource, $formdata)) {
                    $id = $query->getId();

                    $response = array(
                         'code' => 200,
                         'status' => true,
                         'message' => 'Record Inserted Successfully.',
                         'error' => false,
                         'data' => [
                              'id' => $id
                         ],
                    );
               } else {
                    throw new Exception;
               }
          } catch (Exception $e) {
               $response = array(
                    'code' => 201,
                    'status' => false,
                    'message' => 'Cannot Insert Record.',
                    'error' => $e->getMessage(),
                    'data' => []
               );
          }

          header("Content-Type:application/json");
          http_response_code(200);
          echo json_encode($response, JSON_PRETTY_PRINT);
          exit();
     }
}


function process_put($id)
{
     global $resource;
     $formdata = $_REQUEST;
     $query = new Query();

     try {
          if ($query->update($resource, $formdata)->where('id', $id)->commit()) {
               $response = array(
                    'code' => 200,
                    'status' => true,
                    'message' => 'Record Updated Successfully.',
                    'error' => false,
                    'data' => [
                         'id' => $id,
                         'name' => $formdata['name'],
                         'email' => $formdata['email']
                    ],
               );
          } else {
               throw new Exception();
          }
     } catch (Exception $e) {
          $response = array(
               'code' => 201,
               'status' => false,
               'message' => 'Record Updated not  Successfully.',
               'error' => $e->getMessage(),
               'data' => []
          );
     }



     header("Content-Type:application/json");
     http_response_code(200);
     echo json_encode($response, JSON_PRETTY_PRINT);
     exit();
}




function process_patch()
{
}

function process_delete($id)
{
     //method :post formdata _method = DELETE
     global $resource;
     $query = new Query();

     try {
          if ($query->delete($resource)->where('id', $id)->commit()) {
               $response = array(
                    'code' => 200,
                    'status' => true,
                    'message' => 'Record Deleted Successfully.',
                    'error' => false,
                    'data' => [],
               );
          } else {
               throw new Exception();
          }
     } catch (Exception $e) {
          $response = array(
               'code' => 201,
               'status' => false,
               'message' => 'Record not Deleted  Successfully.',
               'error' => $e->getMessage(),
               'data' => []
          );
     }


     header("Content-Type:application/json");
     http_response_code(200);
     echo json_encode($response, JSON_PRETTY_PRINT);
     exit();
}
