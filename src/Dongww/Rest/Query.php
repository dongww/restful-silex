<?php
/**
 * User: dongww
 * Date: 2017/2/20
 * Time: 13:27
 */

namespace Dongww\Rest;


use Symfony\Component\HttpFoundation\Request;

class Query
{
    const KEYWORD_SORT     = 'sort';
    const KEYWORD_FIELDS   = 'fields';
    const KEYWORD_PAGE     = 'page';
    const KEYWORD_PER_PAGE = 'per_page';
    const KEYWORD_EMBED    = 'embed';

    const SEPARATOR = ',';
    const DOT       = '.';

    /**
     * @var Request
     */
    private $request;
    private $perPage;

    private function __construct(Request $request, $perPage = 10)
    {
        $this->request = $request;
        $this->perPage = (int)$perPage;
    }

    public static function createFromRequest(Request $request)
    {
        $query = new Query($request);
    }

    public static function explodeBySeparator($str)
    {
        return explode(static::SEPARATOR, $str);
    }

    public static function explodeByDot($str)
    {
        return explode(static::DOT, $str);
    }

    public function raw($name)
    {
        return $this->request->query->get($name);
    }

    /**
     * 获取排序
     *
     * @return array|null
     */
    public function getSort()
    {
        $sort = $this->raw(static::KEYWORD_SORT);

        if(!$sort) {
            return null;
        }

        $return = [];

        foreach (static::explodeBySeparator($sort) as $item) {
            if($item[0] == '-') {
                $by = 'DESC';
                $order = substr($item, 1);
            } else {
                $by = 'ASC';
                $order = $item;
            }

            $return[] = [
                'order' => $order,
                'by'    => $by,
            ];
        }

        return $return;
    }

    /**
     * 获取需要返回的字段数组。
     *
     * @return array|null
     */
    public function getFields()
    {
        $fields = $this->raw(static::KEYWORD_FIELDS);

        if(!$fields) {
            return null;
        }

        return static::explodeBySeparator($fields);
    }

    public function getPage()
    {
        $page = (int)$this->raw(static::KEYWORD_PAGE);

        return $page ?: 1;
    }

    public function getPerPage()
    {
        $perPage = (int)$this->raw(static::KEYWORD_PER_PAGE);

        return $perPage ?: $this->perPage;
    }

    /**
     * 获取需要嵌入的关联数据的信息
     *
     * @return array|null
     */
    public function getEmbed()
    {
        $embed = $this->raw(static::KEYWORD_EMBED);

        if(!$embed) {
            return null;
        }

        $return = [];

        foreach (static::explodeBySeparator($embed) as $item) {
            $item = self::explodeByDot($item);

            if($item[1]) {
                if($return[$item[0]] == '*') {
                    continue;
                }

                array_merge($return, [
                    $item[0] => [$item[1]],
                ]);
            } else {
                $return[$item[0]] = '*';
            }
        }

        return $return;
    }
}