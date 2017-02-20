<?php
/**
 * User: dongww
 * Date: 2017/1/20
 * Time: 15:42
 */
namespace Dongww\Rest\Http;

use GuzzleHttp\Psr7\Response as BaseResponse;

class Response extends BaseResponse
{
    public function __construct(BaseResponse $response)
    {
        parent::__construct(
            $response->getStatusCode(),
            $response->getHeaders(),
            $response->getBody(),
            $response->getProtocolVersion(),
            $response->getReasonPhrase()
        );
    }

    public function getBody()
    {
        return json_decode(parent::getBody(), true);
    }

    public function getJson()
    {
        return parent::getBody();
    }
}