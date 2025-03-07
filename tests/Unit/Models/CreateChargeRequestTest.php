<?php

namespace MundiAPILib\Tests\Unit\Models;

use MundiAPILib\Models\CreateChargeRequest;
use MundiAPILib\Models\CreateCustomerRequest;
use MundiAPILib\Models\CreatePaymentRequest;
use MundiAPILib\Models\CreateCreditCardPaymentRequest;
use PHPUnit\Framework\TestCase;

class CreateChargeRequestTest extends TestCase
{
    /**
     * @var CreateChargeRequest
     */
    private $chargeRequest;

    protected function setUp(): void
    {
        $this->chargeRequest = new CreateChargeRequest();
    }

    public function testConstructor()
    {
        $this->assertInstanceOf(CreateChargeRequest::class, $this->chargeRequest);
    }

    public function testSetAndGetProperties()
    {
        // Criar objetos necessários
        $customer = new CreateCustomerRequest();
        $customer->name = 'John Doe';
        $customer->email = 'john.doe@example.com';
        
        $creditCardPayment = new CreateCreditCardPaymentRequest();
        $creditCardPayment->installments = 1;
        $creditCardPayment->statementDescriptor = 'Test Charge';
        
        $payment = new CreatePaymentRequest();
        $payment->paymentMethod = 'credit_card';
        $payment->creditCard = $creditCardPayment;
        
        // Definir valores para as propriedades
        $this->chargeRequest->code = 'charge_001';
        $this->chargeRequest->amount = 10000; // R$ 100,00
        $this->chargeRequest->customerId = 'cus_123456';
        $this->chargeRequest->customer = $customer;
        $this->chargeRequest->payment = $payment;
        $this->chargeRequest->metadata = ['key' => 'value'];
        $this->chargeRequest->dueAt = new \DateTime('2024-12-31');
        
        // Verificar se os valores foram definidos corretamente
        $this->assertEquals('charge_001', $this->chargeRequest->code);
        $this->assertEquals(10000, $this->chargeRequest->amount);
        $this->assertEquals('cus_123456', $this->chargeRequest->customerId);
        $this->assertSame($customer, $this->chargeRequest->customer);
        $this->assertSame($payment, $this->chargeRequest->payment);
        $this->assertEquals(['key' => 'value'], $this->chargeRequest->metadata);
        $this->assertInstanceOf(\DateTime::class, $this->chargeRequest->dueAt);
        $this->assertEquals('2024-12-31', $this->chargeRequest->dueAt->format('Y-m-d'));
    }

    public function testJsonSerialize()
    {
        // Criar objetos necessários
        $customer = new CreateCustomerRequest();
        $customer->name = 'John Doe';
        $customer->email = 'john.doe@example.com';
        
        $payment = new CreatePaymentRequest();
        $payment->paymentMethod = 'credit_card';
        
        // Definir valores para as propriedades
        $this->chargeRequest->code = 'charge_001';
        $this->chargeRequest->amount = 10000;
        $this->chargeRequest->customerId = 'cus_123456';
        $this->chargeRequest->customer = $customer;
        $this->chargeRequest->payment = $payment;
        
        // Serializar o objeto para JSON
        $json = json_encode($this->chargeRequest);
        $data = json_decode($json, true);
        
        // Verificar se os valores foram serializados corretamente
        $this->assertArrayHasKey('code', $data);
        $this->assertArrayHasKey('amount', $data);
        $this->assertArrayHasKey('customer_id', $data);
        $this->assertArrayHasKey('customer', $data);
        $this->assertArrayHasKey('payment', $data);
        $this->assertEquals('charge_001', $data['code']);
        $this->assertEquals(10000, $data['amount']);
        $this->assertEquals('cus_123456', $data['customer_id']);
        $this->assertIsArray($data['customer']);
        $this->assertEquals('John Doe', $data['customer']['name']);
        $this->assertEquals('john.doe@example.com', $data['customer']['email']);
        $this->assertIsArray($data['payment']);
        $this->assertEquals('credit_card', $data['payment']['payment_method']);
    }
} 