<?php

namespace MundiAPILib\Tests\Unit\Models;

use MundiAPILib\Models\UpdateOrderStatusRequest;
use PHPUnit\Framework\TestCase;

class UpdateOrderStatusRequestTest extends TestCase
{
    /**
     * @var UpdateOrderStatusRequest
     */
    private $updateRequest;

    protected function setUp(): void
    {
        $this->updateRequest = new UpdateOrderStatusRequest();
    }

    public function testConstructor()
    {
        $this->assertInstanceOf(UpdateOrderStatusRequest::class, $this->updateRequest);
        
        // Testar construtor com parâmetro
        $updateRequestWithParam = new UpdateOrderStatusRequest('paid');
        $this->assertEquals('paid', $updateRequestWithParam->status);
    }

    public function testSetAndGetProperties()
    {
        // Definir valores para as propriedades
        $this->updateRequest->status = 'paid';
        
        // Verificar se os valores foram definidos corretamente
        $this->assertEquals('paid', $this->updateRequest->status);
    }

    public function testJsonSerialize()
    {
        // Definir valores para as propriedades
        $this->updateRequest->status = 'paid';
        
        // Serializar o objeto para JSON
        $json = json_encode($this->updateRequest);
        $data = json_decode($json, true);
        
        // Verificar se os valores foram serializados corretamente
        $this->assertArrayHasKey('status', $data);
        $this->assertEquals('paid', $data['status']);
    }
    
    public function testDifferentStatusValues()
    {
        // Testar diferentes valores de status
        $statusValues = ['paid', 'pending', 'canceled', 'processing'];
        
        foreach ($statusValues as $status) {
            $this->updateRequest->status = $status;
            $this->assertEquals($status, $this->updateRequest->status);
            
            // Verificar serialização
            $json = json_encode($this->updateRequest);
            $data = json_decode($json, true);
            $this->assertEquals($status, $data['status']);
        }
    }
} 