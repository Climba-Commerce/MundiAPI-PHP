<?php

namespace MundiAPILib\Tests\Unit\Controllers;

use MundiAPILib\Controllers\ChargesController;
use MundiAPILib\Http\HttpCallBack;
use MundiAPILib\Http\HttpResponse;
use MundiAPILib\Http\HttpContext;
use MundiAPILib\Http\HttpRequest;
use MundiAPILib\Models\CreateChargeRequest;
use MundiAPILib\Models\UpdateChargeCardRequest;
use MundiAPILib\Models\UpdateChargeDueDateRequest;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class ChargesControllerTest extends TestCase
{
    /**
     * @var ChargesController
     */
    private $controller;
    
    /**
     * @var HttpCallBack
     */
    private $httpCallBack;

    protected function setUp(): void
    {
        $this->controller = ChargesController::getInstance();
        $this->httpCallBack = new HttpCallBack();
        $this->controller->setHttpCallBack($this->httpCallBack);
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
     * Testa a estrutura do método de criação de cobrança
     */
    public function testCreateChargeMethodStructure()
    {
        $reflection = new ReflectionClass(get_class($this->controller));
        $this->assertTrue($reflection->hasMethod('createCharge'));
        
        $method = $reflection->getMethod('createCharge');
        $this->assertTrue($method->isPublic());
        
        $parameters = $method->getParameters();
        $this->assertGreaterThanOrEqual(1, count($parameters));
        $this->assertEquals('request', $parameters[0]->getName());
    }
    
    /**
     * Testa a estrutura do método de atualização de cartão de cobrança
     */
    public function testUpdateChargeCardMethodStructure()
    {
        $reflection = new ReflectionClass(get_class($this->controller));
        $this->assertTrue($reflection->hasMethod('updateChargeCard'));
        
        $method = $reflection->getMethod('updateChargeCard');
        $this->assertTrue($method->isPublic());
        
        $parameters = $method->getParameters();
        $this->assertGreaterThanOrEqual(2, count($parameters));
        $this->assertEquals('chargeId', $parameters[0]->getName());
        $this->assertEquals('request', $parameters[1]->getName());
    }
    
    /**
     * Testa a estrutura do método de atualização da data de vencimento da cobrança
     */
    public function testUpdateChargeDueDateMethodStructure()
    {
        $reflection = new ReflectionClass(get_class($this->controller));
        $this->assertTrue($reflection->hasMethod('updateChargeDueDate'));
        
        $method = $reflection->getMethod('updateChargeDueDate');
        $this->assertTrue($method->isPublic());
        
        $parameters = $method->getParameters();
        $this->assertGreaterThanOrEqual(2, count($parameters));
        $this->assertEquals('chargeId', $parameters[0]->getName());
        $this->assertEquals('request', $parameters[1]->getName());
    }
} 