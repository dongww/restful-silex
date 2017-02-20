<?php
/**
 * User: dongww
 * Date: 2017/2/13
 * Time: 11:15
 */

namespace Dongww\Silex;


use Symfony\Component\HttpFoundation\JsonResponse;

trait RestTrait
{
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
        return $this->abort(401, $this->abortMessage($message, 401), $headers);
    }

    /**
     * 访问受限，授权过期
     *
     * @param string $message
     * @param array  $headers
     */
    public function forbidden($message = '', array $headers = [])
    {
        return $this->abort(403, $this->abortMessage($message, 403), $headers);
    }

    /**
     * 资源，服务未找到
     *
     * @param string $message
     * @param array  $headers
     */
    public function notFound($message = '', array $headers = [])
    {
        return $this->abort(404, $this->abortMessage($message, 404), $headers);
    }

    /**
     * 接口未实现
     *
     * @param string $message
     * @param array  $headers
     */
    public function notImplemented($message = '', array $headers = [])
    {
        return $this->abort(501, $this->abortMessage($message, 501), $headers);
    }

    private function abortMessage($message, $code)
    {
        return $message ?: $this['rest.default_error_messages'][$code];
    }
}