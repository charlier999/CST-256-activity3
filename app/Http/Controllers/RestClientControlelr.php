<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;


class RestClientControlelr extends Controller
{
    /**
     * 
     */
    public function index()
    {
        // Call Rest API
        $serviceURL = "http://localhost/activity3/public/";
        $api = "usersrest";
        $param = "";
        $uri = $api . "/" . $param;
        
        try 
        {
            // Make Rest Call
            $client = new Client(['base_uri' => $serviceURL]);
            $response = $client->request('GET', $uri);
            
            if($response->getStatusCode() == 200)
                return $response->getBody();
            else
                return "There was an error: " . $response->getStatusCode();
        } 
        catch (ClientException $e) 
        {
            return "There was an exception: " . $e->getMessage();
        }
    }
    
    
    public function show($id)
    {
        // Call Rest API
        $serviceURL = "http://localhost/activity3/public/";
        $api = "usersrest";
        $param = $id;
        $uri = $api . "/" . $param;
        
        try
        {
            // Make Rest Call
            $client = new Client(['base_uri' => $serviceURL]);
            $response = $client->request('GET', $uri);
            
            if($response->getStatusCode() == 200)
                return $response->getBody();
                else
                    return "There was an error: " . $response->getStatusCode();
        }
        catch (ClientException $e)
        {
            return "There was an exception: " . $e->getMessage();
        }
    }
}
