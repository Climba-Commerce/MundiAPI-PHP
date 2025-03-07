<?php

namespace MundiAPILib\Tests\Unit\Controllers;

use MundiAPILib\Controllers\BaseController;
use MundiAPILib\Http\HttpCallBack;
use PHPUnit\Framework\TestCase;

class BaseControllerTest extends TestCase
{
    /**
     * @var BaseController
     */
    private $controller;

    protected function setUp(): void
    {
        $this->controller = new class extends BaseController {};
    }

    public function testHttpCallBack()
    {
        $httpCallBack = new HttpCallBack();
        $this->controller->setHttpCallBack($httpCallBack);
        
        $result = $this->controller->getHttpCallBack();
        $this->assertSame($httpCallBack, $result);
    }
} 