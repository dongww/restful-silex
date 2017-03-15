<?php
/**
 * User: dongww
 * Date: 2017/2/13
 * Time: 11:15
 */
namespace Dongww\Silex;

use Dongww\Silex\Exception\NotImplementedException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

trait RestTrait
{
    /**
     * @param array $data
     * @param int   $status
     * @param array $headers
     *
     * @return JsonResponse
     */
    public function json($data = [], $status = 200, array $headers = [])
    {
        $headers = $headers + $this['rest.headers'];

        return parent::json($data, $status, $headers);
    }

    /**
     * 已创建
     *
     * @param array $data
     * @param array $headers
     *
     * @return JsonResponse
     */
    public function created($data = [], array $headers = [])
    {
        return $this->json($data, 201, $headers);
    }

    /**
     * 无返回内容
     *
     * @param array $headers
     *
     * @return JsonResponse
     */
    public function noContent(array $headers = [])
    {
        return $this->json(null, 204, $headers);
    }

    /**
     * 未授权
     *
     * @param string $message
     * @param array  $headers
     */
    public function unauthorized($message = '', array $headers = [])
    {
        $ex = new UnauthorizedHttpException('', $this->codeMessage($message, 401));
        $ex->setHeaders($headers);

        throw $ex;
    }

    /**
     * 访问受限，授权过期
     *
     * @param string $message
     * @param array  $headers
     */
    public function forbidden($message = '', array $headers = [])
    {
        $ex = new AccessDeniedHttpException($this->codeMessage($message, 403));
        $ex->setHeaders($headers);

        throw $ex;
    }

    /**
     * 资源，服务未找到
     *
     * @param string $message
     * @param array  $headers
     */
    public function notFound($message = '', array $headers = [])
    {
        $ex = new NotFoundHttpException($this->codeMessage($message, 404));
        $ex->setHeaders($headers);

        throw $ex;
    }

    /**
     * 接口未实现
     *
     * @param string $message
     * @param array  $headers
     */
    public function notImplemented($message = '', array $headers = [])
    {
        $ex = new NotImplementedException($this->codeMessage($message, 501));
        $ex->setHeaders($headers);

        throw $ex;
    }

    private function codeMessage($message, $code)
    {
        return $message ?: $this['rest.code_default_messages'][$code];
    }
}