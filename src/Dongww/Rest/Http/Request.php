<?php
/**
 * User: dongww
 * Date: 2017/3/15
 * Time: 10:15
 */

namespace Dongww\Rest\Http;

use Dongww\Rest\Query;
use Symfony\Component\HttpFoundation\Request as BaseRequest;

class Request extends BaseRequest
{
    public $restContent;
    /**
     * @var Query
     */
    public $restQuery;

    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null, $restOption = [])
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);

        $this->restContent = json_decode($this->getContent(), true);
        $this->restQuery   = new Query($this->query);
    }
}