<?php
/**
 * User: dongww
 * Date: 2017/3/15
 * Time: 19:13
 */

namespace Dongww\Rest\Exception;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException as BaseException;

class NotFoundHttpException extends BaseException implements ExceptionInterface
{
}