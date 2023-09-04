<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Simple API function to exit the doc and provide a Json response
 *
 * @param mixed $data
 * @return void
 */
function APIFinish($data = null){

    // Make sure to change the response type to json
    header('Content-type: application/json');

    // Check for arrays 
    if(is_array($data)){
        $response = [
            'status' => 1
        ];

        $response = array_merge($response, $data);

    } else {
        $response = [
            'status' => 1,
            'message' => $data
        ];
    }

    // Echo out the response and kill the process
    echo json_encode($response);
    die();

}


/**
 * API Response for errors
 *
 * @param mixed $data
 * @param boolean $hasMutliple
 * @return void
 */
function APIError($data = null, $hasMutliple = false){

    // Make sure to change the response type to json
    header('Content-type: application/json');

    // Check for arrays 
    if(is_array($data) && $hasMutliple === false){
        $response = [
            'status' => 0
        ];

        $response = array_merge($response, $data);

    } elseif($hasMutliple == false) {
        $response = [
            'status' => 0,
            'message' => $data
        ];
    } else {
        $response = [
            'status' => 0,
            'message' => 'Multiple errors',
            'errors' => $data
        ];
    }

    // Echo out the response and kill the process
    echo json_encode($response);
    die();

}