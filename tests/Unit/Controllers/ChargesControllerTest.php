<?php

namespace MundiAPILib\Tests\Unit\Controllers;

use MundiAPILib\Controllers\ChargesController;
use MundiAPILib\Http\HttpCallBack;
use PHPUnit\Framework\TestCase;

class ChargesControllerTest extends TestCase
{
    /**
     * @var ChargesController
     */
    private $controller;

    protected function setUp(): void
    {
        $this->controller = ChargesController::getInstance();
    }

    public function testGetInstance()
    {
        $instance1 = ChargesController::getInstance();
        $instance2 = ChargesController::getInstance();
        
        $this->assertInstanceOf(ChargesController::class, $instance1);
        $this->assertSame($instance1, $instance2);
    }

    public function testHttpCallBack()
    {
        $httpCallBack = new HttpCallBack();
        $this->controller->setHttpCallBack($httpCallBack);
        
        $result = $this->controller->getHttpCallBack();
        $this->assertSame($httpCallBack, $result);
    }
} 