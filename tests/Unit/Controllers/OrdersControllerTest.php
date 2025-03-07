<?php

namespace MundiAPILib\Tests\Unit\Controllers;

use MundiAPILib\Controllers\OrdersController;
use MundiAPILib\Http\HttpCallBack;
use PHPUnit\Framework\TestCase;

class OrdersControllerTest extends TestCase
{
    /**
     * @var OrdersController
     */
    private $controller;

    protected function setUp(): void
    {
        $this->controller = OrdersController::getInstance();
    }

    public function testGetInstance()
    {
        $instance1 = OrdersController::getInstance();
        $instance2 = OrdersController::getInstance();
        
        $this->assertInstanceOf(OrdersController::class, $instance1);
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