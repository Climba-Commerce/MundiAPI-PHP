<?php

namespace MundiAPILib\Tests\Unit\Controllers;

use MundiAPILib\Controllers\OrdersController;
use MundiAPILib\Http\HttpCallBack;
use MundiAPILib\Http\HttpResponse;
use MundiAPILib\Http\HttpContext;
use MundiAPILib\Http\HttpRequest;
use MundiAPILib\Models\CreateOrderRequest;
use MundiAPILib\Models\UpdateOrderStatusRequest;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class OrdersControllerTest extends TestCase
{
    /**
     * @var OrdersController
     */
    private $controller;
    
    /**
     * @var HttpCallBack
     */
    private $httpCallBack;

    protected function setUp(): void
    {
        $this->controller = OrdersController::getInstance();
        $this->httpCallBack = new HttpCallBack();
        $this->controller->setHttpCallBack($this->httpCallBack);
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
    
    /**
     * Testa a validação de resposta para diferentes códigos HTTP
     */
    public function testValidateResponse()
    {
        // Usar reflexão para acessar o método protegido validateResponse
        $reflection = new ReflectionClass(get_class($this->controller));
        $method = $reflection->getMethod('validateResponse');
        $method->setAccessible(true);
        
        // Criar um contexto HTTP com request e response mockados
        $request = new HttpRequest();
        $response = new HttpResponse(200, [], null);
        $httpContext = new HttpContext($request, $response, null);
        
        // Testar resposta com código 200 (sucesso)
        $response = new HttpResponse(200, [], null);
        $result = $method->invoke($this->controller, $response, $httpContext);
        $this->assertNull($result); // Não deve lançar exceção
        
        // Testar resposta com código 201 (criado)
        $response = new HttpResponse(201, [], null);
        $result = $method->invoke($this->controller, $response, $httpContext);
        $this->assertNull($result); // Não deve lançar exceção
    }
    
    /**
     * Testa a estrutura do método de criação de pedido
     */
    public function testCreateOrderMethodStructure()
    {
        $reflection = new ReflectionClass(get_class($this->controller));
        $this->assertTrue($reflection->hasMethod('createOrder'));
        
        $method = $reflection->getMethod('createOrder');
        $this->assertTrue($method->isPublic());
        
        $parameters = $method->getParameters();
        $this->assertGreaterThanOrEqual(1, count($parameters));
        $this->assertEquals('body', $parameters[0]->getName());
    }
    
    /**
     * Testa a estrutura do método de atualização de status do pedido
     */
    public function testUpdateOrderStatusMethodStructure()
    {
        $reflection = new ReflectionClass(get_class($this->controller));
        $this->assertTrue($reflection->hasMethod('updateOrderStatus'));
        
        $method = $reflection->getMethod('updateOrderStatus');
        $this->assertTrue($method->isPublic());
        
        $parameters = $method->getParameters();
        $this->assertGreaterThanOrEqual(2, count($parameters));
        $this->assertEquals('id', $parameters[0]->getName());
        $this->assertEquals('request', $parameters[1]->getName());
    }
    
    /**
     * Testa a estrutura do método de obtenção de pedido
     */
    public function testGetOrderMethodStructure()
    {
        $reflection = new ReflectionClass(get_class($this->controller));
        $this->assertTrue($reflection->hasMethod('getOrder'));
        
        $method = $reflection->getMethod('getOrder');
        $this->assertTrue($method->isPublic());
        
        $parameters = $method->getParameters();
        $this->assertGreaterThanOrEqual(1, count($parameters));
        $this->assertEquals('orderId', $parameters[0]->getName());
    }
    
    /**
     * Testa a estrutura do método de listagem de pedidos
     */
    public function testGetOrdersMethodStructure()
    {
        $reflection = new ReflectionClass(get_class($this->controller));
        $this->assertTrue($reflection->hasMethod('getOrders'));
        
        $method = $reflection->getMethod('getOrders');
        $this->assertTrue($method->isPublic());
        
        $parameters = $method->getParameters();
        $this->assertGreaterThanOrEqual(0, count($parameters));
    }
} 