<?php

namespace MundiAPILib\Tests\Unit\Models;

use MundiAPILib\Models\CreateOrderRequest;
use MundiAPILib\Models\CreateCustomerRequest;
use MundiAPILib\Models\CreatePaymentRequest;
use MundiAPILib\Models\CreateOrderItemRequest;
use PHPUnit\Framework\TestCase;

class CreateOrderRequestTest extends TestCase
{
    /**
     * @var CreateOrderRequest
     */
    private $orderRequest;

    protected function setUp(): void
    {
        $this->orderRequest = new CreateOrderRequest();
    }

    public function testConstructor()
    {
        $this->assertInstanceOf(CreateOrderRequest::class, $this->orderRequest);
    }

    public function testSetAndGetProperties()
    {
        // Criar objetos necessários
        $customer = new CreateCustomerRequest();
        $customer->name = 'John Doe';
        $customer->email = 'john.doe@example.com';
        
        $item1 = new CreateOrderItemRequest();
        $item1->amount = 5000; // R$ 50,00
        $item1->description = 'Product 1';
        $item1->quantity = 1;
        
        $item2 = new CreateOrderItemRequest();
        $item2->amount = 3000; // R$ 30,00
        $item2->description = 'Product 2';
        $item2->quantity = 2;
        
        $payment = new CreatePaymentRequest();
        $payment->paymentMethod = 'credit_card';
        
        // Definir valores para as propriedades
        $this->orderRequest->code = 'order_001';
        $this->orderRequest->customerId = 'cus_123456';
        $this->orderRequest->customer = $customer;
        $this->orderRequest->items = [$item1, $item2];
        $this->orderRequest->payments = [$payment];
        $this->orderRequest->metadata = ['key' => 'value'];
        $this->orderRequest->closed = true;
        
        // Verificar se os valores foram definidos corretamente
        $this->assertEquals('order_001', $this->orderRequest->code);
        $this->assertEquals('cus_123456', $this->orderRequest->customerId);
        $this->assertSame($customer, $this->orderRequest->customer);
        $this->assertIsArray($this->orderRequest->items);
        $this->assertCount(2, $this->orderRequest->items);
        $this->assertSame($item1, $this->orderRequest->items[0]);
        $this->assertSame($item2, $this->orderRequest->items[1]);
        $this->assertIsArray($this->orderRequest->payments);
        $this->assertCount(1, $this->orderRequest->payments);
        $this->assertSame($payment, $this->orderRequest->payments[0]);
        $this->assertEquals(['key' => 'value'], $this->orderRequest->metadata);
        $this->assertTrue($this->orderRequest->closed);
    }

    public function testJsonSerialize()
    {
        // Criar objetos necessários
        $customer = new CreateCustomerRequest();
        $customer->name = 'John Doe';
        $customer->email = 'john.doe@example.com';
        
        $item = new CreateOrderItemRequest();
        $item->amount = 5000;
        $item->description = 'Product 1';
        $item->quantity = 1;
        
        $payment = new CreatePaymentRequest();
        $payment->paymentMethod = 'credit_card';
        
        // Definir valores para as propriedades
        $this->orderRequest->code = 'order_001';
        $this->orderRequest->customerId = 'cus_123456';
        $this->orderRequest->customer = $customer;
        $this->orderRequest->items = [$item];
        $this->orderRequest->payments = [$payment];
        
        // Serializar o objeto para JSON
        $json = json_encode($this->orderRequest);
        $data = json_decode($json, true);
        
        // Verificar se os valores foram serializados corretamente
        $this->assertArrayHasKey('code', $data);
        $this->assertArrayHasKey('customer_id', $data);
        $this->assertArrayHasKey('customer', $data);
        $this->assertArrayHasKey('items', $data);
        $this->assertArrayHasKey('payments', $data);
        $this->assertEquals('order_001', $data['code']);
        $this->assertEquals('cus_123456', $data['customer_id']);
        $this->assertIsArray($data['customer']);
        $this->assertEquals('John Doe', $data['customer']['name']);
        $this->assertEquals('john.doe@example.com', $data['customer']['email']);
        $this->assertIsArray($data['items']);
        $this->assertCount(1, $data['items']);
        $this->assertEquals(5000, $data['items'][0]['amount']);
        $this->assertEquals('Product 1', $data['items'][0]['description']);
        $this->assertEquals(1, $data['items'][0]['quantity']);
        $this->assertIsArray($data['payments']);
        $this->assertCount(1, $data['payments']);
        $this->assertEquals('credit_card', $data['payments'][0]['payment_method']);
    }
} 