<?php
/**
 * Created by PhpStorm.
 * User: dongww
 * Date: 2017/4/5
 * Time: 10:00
 */

namespace Dongww\Rest\Resource;


interface ResourceInterface
{
    public function filterByGroup($groupName);
}