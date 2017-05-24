<?php
/**
 * Created by PhpStorm.
 * User: dongww
 * Date: 2017/4/5
 * Time: 10:01
 */

namespace Dongww\Rest\Resource;


interface ResourceRepositoryInterface
{
    public function getCollection();

    public function getSingle($id);

    public function add(ResourceInterface $resource);

    public function update(ResourceInterface $resource);

    public function remove(ResourceInterface $resource);
}