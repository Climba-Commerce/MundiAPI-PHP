<?php

namespace MundiAPILib\Tests\Unit\Models;

use MundiAPILib\Models\GetCardResponse;
use PHPUnit\Framework\TestCase;

class GetCardResponseTest extends TestCase
{
    /**
     * @var GetCardResponse
     */
    private $cardResponse;

    protected function setUp(): void
    {
        $this->cardResponse = new GetCardResponse();
    }

    public function testConstructor()
    {
        $this->assertInstanceOf(GetCardResponse::class, $this->cardResponse);
    }

    public function testSetAndGetProperties()
    {
        // Definir valores para as propriedades
        $this->cardResponse->id = 'card_123456';
        $this->cardResponse->lastFourDigits = '1234';
        $this->cardResponse->brand = 'Visa';
        $this->cardResponse->holderName = 'John Doe';
        $this->cardResponse->expMonth = 12;
        $this->cardResponse->expYear = 2025;
        $this->cardResponse->status = 'active';
        $this->cardResponse->type = 'credit';
        
        // Verificar se os valores foram definidos corretamente
        $this->assertEquals('card_123456', $this->cardResponse->id);
        $this->assertEquals('1234', $this->cardResponse->lastFourDigits);
        $this->assertEquals('Visa', $this->cardResponse->brand);
        $this->assertEquals('John Doe', $this->cardResponse->holderName);
        $this->assertEquals(12, $this->cardResponse->expMonth);
        $this->assertEquals(2025, $this->cardResponse->expYear);
        $this->assertEquals('active', $this->cardResponse->status);
        $this->assertEquals('credit', $this->cardResponse->type);
    }

    public function testJsonSerialize()
    {
        // Definir valores para as propriedades
        $this->cardResponse->id = 'card_123456';
        $this->cardResponse->lastFourDigits = '1234';
        $this->cardResponse->brand = 'Visa';
        $this->cardResponse->holderName = 'John Doe';
        
        // Serializar o objeto para JSON
        $json = json_encode($this->cardResponse);
        $data = json_decode($json, true);
        
        // Verificar se os valores foram serializados corretamente
        $this->assertArrayHasKey('id', $data);
        $this->assertArrayHasKey('last_four_digits', $data);
        $this->assertArrayHasKey('brand', $data);
        $this->assertArrayHasKey('holder_name', $data);
        $this->assertEquals('card_123456', $data['id']);
        $this->assertEquals('1234', $data['last_four_digits']);
        $this->assertEquals('Visa', $data['brand']);
        $this->assertEquals('John Doe', $data['holder_name']);
    }
} 