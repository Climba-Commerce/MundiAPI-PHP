<?php

namespace MundiAPILib\Tests\Unit\Models;

use MundiAPILib\Models\GetCustomerResponse;
use PHPUnit\Framework\TestCase;

class GetCustomerResponseTest extends TestCase
{
    /**
     * @var GetCustomerResponse
     */
    private $customerResponse;

    protected function setUp(): void
    {
        $this->customerResponse = new GetCustomerResponse();
    }

    public function testConstructor()
    {
        $this->assertInstanceOf(GetCustomerResponse::class, $this->customerResponse);
    }

    public function testSetAndGetProperties()
    {
        // Definir valores para as propriedades
        $this->customerResponse->id = 'cus_123456';
        $this->customerResponse->name = 'John Doe';
        $this->customerResponse->email = 'john.doe@example.com';
        $this->customerResponse->delinquent = false;
        $this->customerResponse->document = '12345678900';
        $this->customerResponse->type = 'individual';
        $this->customerResponse->code = 'customer_001';
        
        // Verificar se os valores foram definidos corretamente
        $this->assertEquals('cus_123456', $this->customerResponse->id);
        $this->assertEquals('John Doe', $this->customerResponse->name);
        $this->assertEquals('john.doe@example.com', $this->customerResponse->email);
        $this->assertEquals(false, $this->customerResponse->delinquent);
        $this->assertEquals('12345678900', $this->customerResponse->document);
        $this->assertEquals('individual', $this->customerResponse->type);
        $this->assertEquals('customer_001', $this->customerResponse->code);
    }

    public function testJsonSerialize()
    {
        // Definir valores para as propriedades
        $this->customerResponse->id = 'cus_123456';
        $this->customerResponse->name = 'John Doe';
        $this->customerResponse->email = 'john.doe@example.com';
        $this->customerResponse->delinquent = false;
        
        // Serializar o objeto para JSON
        $json = json_encode($this->customerResponse);
        $data = json_decode($json, true);
        
        // Verificar se os valores foram serializados corretamente
        $this->assertArrayHasKey('id', $data);
        $this->assertArrayHasKey('name', $data);
        $this->assertArrayHasKey('email', $data);
        $this->assertArrayHasKey('delinquent', $data);
        $this->assertEquals('cus_123456', $data['id']);
        $this->assertEquals('John Doe', $data['name']);
        $this->assertEquals('john.doe@example.com', $data['email']);
        $this->assertEquals(false, $data['delinquent']);
    }
} 