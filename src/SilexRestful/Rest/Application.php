<?php
/**
 * User: dongww
 * Date: 2017/1/19
 * Time: 14:50
 */

namespace SilexRestful\Rest;

use Dongww\Silex\RestTrait;
use Silex\Application as BaseApp;

class Application extends BaseApp
{
    use RestTrait;
}