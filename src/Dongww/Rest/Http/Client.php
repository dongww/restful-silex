<?php
/**
 * User: dongww
 * Date: 2017/1/20
 * Time: 15:20
 */
namespace Dongww\Rest\Http;

use \GuzzleHttp\Client as GuzzleHttpClient;
use Psr\Http\Message\ResponseInterface;

class Client
{
    /** @var GuzzleHttpClient */
    private $httpClient;

    /** @var  ResponseInterface */
    private $lastResponse;

    public function __construct(GuzzleHttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function request($method, $path, array $options = [])
    {
        $response = $this->httpClient->request($method, $path, $options);
        $this->lastResponse = new Response($response);

        return $this->lastResponse;
    }

    public function get($path, array $options = [])
    {
        return $this->request('GET', $path, $options);
    }

    public function post($path, array $options = [])
    {
        return $this->request('POST', $path, $options);
    }

    public function put($path, array $options = [])
    {
        return $this->request('PUT', $path, $options);
    }

    public function delete($path, array $options = [])
    {
        return $this->request('DELETE', $path, $options);
    }

    public function patch($path, array $options = [])
    {
        return $this->request('PATCH', $path, $options);
    }
}