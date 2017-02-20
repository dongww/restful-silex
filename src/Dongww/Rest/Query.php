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
    const KEYWORDS = [
        'sort',
        'fields',
        'page',
        'per_page',
        'embed',
    ];

    const SEPARATOR = ',';

    /**
     * @var Request
     */
    private $request;

    private function __construct(Request $request)
    {

    }

    public static function createFromRequest(Request $request)
    {
        $query = new Query($request);
    }

    public function getSort()
    {
        $sort = $this->request->query->get('sort');

        if(!$sort) {
            return null;
        }

        $sort = explode(static::SEPARATOR, $sort);

        $orderBy = [];

        foreach ($sort as $item) {
            if($item[0] == '-') {
                $by = 'DESC';
                $order = substr($item, 1);
            } else {
                $by = 'ASC';
                $order = $item;
            }

            $orderBy[] = [
                'order' => $order,
                'by'    => $by,
            ];
        }

        return $orderBy;
    }
}