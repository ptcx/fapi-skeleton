<?php
/**
 * 所有Controller均需继承此基类
 */
namespace App\Http\Controllers;

use \Interop\Container\ContainerInterface;

abstract class Controller
{
    protected $ci;

    public function __construct(ContainerInterface $ci)
    {
        $this->ci = $ci;
    }
}
