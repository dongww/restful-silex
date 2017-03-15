<?php
/**
 * User: dongww
 * Date: 2017/3/15
 * Time: 15:16
 */
namespace Dongww\Rest\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;

class NotImplementedException extends HttpException implements ExceptionInterface
{
    public function __construct($message = null, \Exception $previous = null, $code = 0)
    {
        parent::__construct(501, $message, $previous, array(), $code);
    }
}