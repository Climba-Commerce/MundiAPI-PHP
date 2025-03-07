<?php

namespace MundiAPILib\Tests\Unit\Models;

use MundiAPILib\Models\CreateCustomerRequest;
use MundiAPILib\Models\CreateAddressRequest;
use PHPUnit\Framework\TestCase;

class CreateCustomerRequestTest extends TestCase
{
    /**
     * @var CreateCustomerRequest
     */
    private $customerRequest;

    protected function setUp(): void
    {
        $this->customerRequest = new CreateCustomerRequest();
    }

    public function testConstructor()
    {
        $this->assertInstanceOf(CreateCustomerRequest::class, $this->customerRequest);
    }

    public function testSetAndGetProperties()
    {
        // Criar um objeto de endereço
        $address = new CreateAddressRequest();
        $address->street = 'Rua Teste';
        $address->number = '123';
        $address->zipCode = '12345-678';
        $address->neighborhood = 'Bairro Teste';
        $address->city = 'Cidade Teste';
        $address->state = 'Estado Teste';
        $address->country = 'Brasil';
        
        // Definir valores para as propriedades
        $this->customerRequest->name = 'John Doe';
        $this->customerRequest->email = 'john.doe@example.com';
        $this->customerRequest->document = '12345678900';
        $this->customerRequest->type = 'individual';
        $this->customerRequest->address = $address;
        $this->customerRequest->code = 'customer_001';
        $this->customerRequest->phones = null;
        
        // Verificar se os valores foram definidos corretamente
        $this->assertEquals('John Doe', $this->customerRequest->name);
        $this->assertEquals('john.doe@example.com', $this->customerRequest->email);
        $this->assertEquals('12345678900', $this->customerRequest->document);
        $this->assertEquals('individual', $this->customerRequest->type);
        $this->assertSame($address, $this->customerRequest->address);
        $this->assertEquals('customer_001', $this->customerRequest->code);
        $this->assertNull($this->customerRequest->phones);
    }

    public function testJsonSerialize()
    {
        // Criar um objeto de endereço
        $address = new CreateAddressRequest();
        $address->street = 'Rua Teste';
        $address->number = '123';
        
        // Definir valores para as propriedades
        $this->customerRequest->name = 'John Doe';
        $this->customerRequest->email = 'john.doe@example.com';
        $this->customerRequest->document = '12345678900';
        $this->customerRequest->type = 'individual';
        $this->customerRequest->address = $address;
        
        // Serializar o objeto para JSON
        $json = json_encode($this->customerRequest);
        $data = json_decode($json, true);
        
        // Verificar se os valores foram serializados corretamente
        $this->assertArrayHasKey('name', $data);
        $this->assertArrayHasKey('email', $data);
        $this->assertArrayHasKey('document', $data);
        $this->assertArrayHasKey('type', $data);
        $this->assertArrayHasKey('address', $data);
        $this->assertEquals('John Doe', $data['name']);
        $this->assertEquals('john.doe@example.com', $data['email']);
        $this->assertEquals('12345678900', $data['document']);
        $this->assertEquals('individual', $data['type']);
        $this->assertIsArray($data['address']);
        $this->assertEquals('Rua Teste', $data['address']['street']);
        $this->assertEquals('123', $data['address']['number']);
    }
} 