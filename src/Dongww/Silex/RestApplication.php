<?php
/**
 * User: dongww
 * Date: 2017/1/19
 * Time: 14:50
 */
namespace Dongww\Silex;

use Dongww\Silex\RestTrait;
use Silex\Application;

class RestApplication extends Application
{
    use RestTrait;
}