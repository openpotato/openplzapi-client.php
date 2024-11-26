<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

namespace OpenPlzApi;

 /**
 * A factory class for ApiBaseClient instances.
 */
class ApiClientFactory
 {
     private $baseUrl;
 
     /**
      * Initializes a new instance of the ApiClientFactory class.
      *
      * @param string $baseUrl  The base URL for API clients
      */
     public function __construct($baseUrl)
     {
         $this->baseUrl = $baseUrl;
     }
 
     /**
      * Creates and returns an API client for the specified client class.
      *
      * @param class-string $clientClass  The fully-qualified class name of the API client
      * @return ApiBaseClient  The country-specific API client
      * @throws \InvalidArgumentException  If the class does not extend ApiBaseClient
      */
     public function createClient($clientClass): ApiBaseClient
     {
         if (class_exists($clientClass)) {

            $client = new $clientClass($this->baseUrl);
            
            if (!$client instanceof ApiBaseClient) {
                throw new \InvalidArgumentException("Class $clientClass must extend ApiBaseClient.");
            }
    
            return $client;
        }
        else{
            throw new \InvalidArgumentException("Class $clientClass does not exist.");            
        }
     }
 }
 