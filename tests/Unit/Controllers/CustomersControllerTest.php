<?php

namespace MundiAPILib\Tests\Unit\Controllers;

use MundiAPILib\Controllers\CustomersController;
use MundiAPILib\Http\HttpCallBack;
use PHPUnit\Framework\TestCase;

class CustomersControllerTest extends TestCase
{
    /**
     * @var CustomersController
     */
    private $controller;

    protected function setUp(): void
    {
        $this->controller = CustomersController::getInstance();
    }

    public function testGetInstance()
    {
        $instance1 = CustomersController::getInstance();
        $instance2 = CustomersController::getInstance();
        
        $this->assertInstanceOf(CustomersController::class, $instance1);
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