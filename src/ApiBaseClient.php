<?php
/**
 * Copyright (c) STÜBER SYSTEMS GmbH
 * Licensed under the MIT License, Version 2.0.
 */

 namespace OpenPlzApi;

use \Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

/**
 * An abstract base class for API client implementations.
 */
abstract class ApiBaseClient
{
    private $baseUrl;
    private $client;
 
    /**
     * Initializes a new instance of the ApiBaseClient class.
     *
     * @param string $baseUrl  The base URL of the OpenPLZ API
     * @param Client|null $client  An optional Guzzle HTTP client
     */
    public function __construct(string $baseUrl = 'https://openplzapi.org', $client = null)
    {
        $this->baseUrl = $baseUrl;
        $this->client = $client ?? new Client(['base_uri' => $baseUrl]);
    }
 
    /**
     * Combines base URL and relative URL to create a full URL.
     *
     * @param string $relativeUrl  The relative URL path
     * @return string  The full URL
     */
    protected function createUrl(string $relativeUrl = ""): string
    {
       return rtrim($this->baseUrl, '/') . '/' . ltrim($relativeUrl, '/');
    }
 
    /**
     * Requests an API endpoint and return back a list of elements
     *
     * @param string $url  The requests url
     * @param string $modelClass  The type of the element to be returned
     * @return ReadOnlyList  The list of elements
     */
    protected function getList(string $url, string $modelClass): ReadOnlyList
    {
        try {

            $headers = ['Accept' => 'application/json'];

            $response = $this->client->get($url, ['headers' => $headers]);

            return ReadOnlyList::fromJson($response, $modelClass);

        } catch (RequestException $e) {
            $this->handleResponse($e->getResponse());
            throw $e;
        }
    }     

    /**
     * Request an API endpoint and return back a page of elements
     *
     * @param string $url  The requests url
     * @param string $modelClass  The type of the element to be returned
     * @param string $nextPage  A callable for the getting the next page.
     * @return ReadOnlyPagedList  The page of elements
     */
    protected function getPage(string $url, array $params, string $modelClass, callable $nextPage): ReadOnlyPagedList
    {
        try {

            $headers = ['Accept' => 'application/json'];

            $response = $this->client->get($url, [
                'query' => $params,
                'headers' => $headers,
            ]);

            return ReadOnlyPagedList::fromJson($response, $modelClass, $nextPage);

        } catch (RequestException $e) {
            $this->handleResponse($e->getResponse());
            throw $e;
        }
    }    

    /**
     * Handles an error response by checking whether it is an RFC 7807 problem details object. 
     * If so, a ProblemDetailsException exception is thrown.
     *
     * @param ?ResponseInterface $response  The HTTP response object
     */
    private function handleResponse(?ResponseInterface $response): void
    {
        if (!is_null($response) && $response->getStatusCode() != 200) {
            $contentType = $response->getHeaderLine('Content-Type');
            if (strpos($contentType, 'application/problem+json') !== false) {
                
                $problemDetails = json_decode($response->getBody(), true);

                throw new ProblemDetailsException(
                    $problemDetails['type'],
                    $problemDetails['title'],
                    (int)$problemDetails['status'],
                    $problemDetails['detail'] ?? null,
                    $problemDetails['instance'] ?? null,
                    $problemDetails['traceId'] ?? null,
                    array_diff_key($problemDetails['errors'] ?? [])
                );
            }
        }
    }
}
 