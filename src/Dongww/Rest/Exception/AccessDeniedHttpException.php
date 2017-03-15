<?php
/**
 * User: dongww
 * Date: 2017/3/15
 * Time: 19:11
 */
namespace Dongww\Rest\Exception;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException as BaseException;

class AccessDeniedHttpException extends BaseException implements ExceptionInterface
{
}