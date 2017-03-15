<?php
/**
 * User: dongww
 * Date: 2017/2/20
 * Time: 13:27
 */

namespace Dongww\Rest;

use Symfony\Component\HttpFoundation\ParameterBag;

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
     * @var ParameterBag
     */
    private $rawQuery;
    public  $defaultPerPage;
    public  $page;
    public  $perPage;
    public  $sort;
    public  $fields;
    public $embed;

    public function __construct(ParameterBag $query, $defaultPerPage = 10)
    {
        $this->rawQuery       = $query;
        $this->defaultPerPage = $defaultPerPage;

        $this->perPage = $this->getPerPage();
        $this->sort    = $this->getSort();
        $this->fields  = $this->getFields();
        $this->page    = $this->getPage();
        $this->embed  = $this->getEmbed();
    }

    protected static function explodeBySeparator($str)
    {
        return explode(static::SEPARATOR, $str);
    }

    protected static function explodeByDot($str)
    {
        return explode(static::DOT, $str);
    }

    /**
     * 获取排序
     *
     * @return array|null
     */
    protected function getSort()
    {
        $sort = $this->rawQuery->get(static::KEYWORD_SORT);

        if(!$sort) {
            return null;
        }

        $return = [];

        foreach (static::explodeBySeparator($sort) as $item) {
            if($item[0] == '-') {
                $by    = 'DESC';
                $order = substr($item, 1);
            } else {
                $by    = 'ASC';
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
    protected function getFields()
    {
        $fields = $this->rawQuery->get(static::KEYWORD_FIELDS);

        if(!$fields) {
            return null;
        }

        return static::explodeBySeparator($fields);
    }

    protected function getPage()
    {
        $page = (int)$this->rawQuery->get(static::KEYWORD_PAGE);

        return $page ?: 1;
    }

    protected function getPerPage()
    {
        $perPage = (int)$this->rawQuery->get(static::KEYWORD_PER_PAGE);

        return $perPage ?: $this->defaultPerPage;
    }

    /**
     * 获取需要嵌入的关联数据的信息
     *
     * @return array|null
     */
    protected function getEmbed()
    {
        $embed = $this->rawQuery->get(static::KEYWORD_EMBED);

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