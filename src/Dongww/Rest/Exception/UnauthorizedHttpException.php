<?php
/**
 * User: dongww
 * Date: 2017/3/15
 * Time: 19:09
 */

namespace Dongww\Rest\Exception;

use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException as BaseException;

class UnauthorizedHttpException extends BaseException implements ExceptionInterface
{
}