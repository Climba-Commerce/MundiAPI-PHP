<?php

namespace MundiAPILib\Tests\Unit\Models;

use MundiAPILib\Models\UpdateChargeCardRequest;
use MundiAPILib\Models\CreateCardRequest;
use PHPUnit\Framework\TestCase;

class UpdateChargeCardRequestTest extends TestCase
{
    /**
     * @var UpdateChargeCardRequest
     */
    private $updateRequest;

    protected function setUp(): void
    {
        $this->updateRequest = new UpdateChargeCardRequest();
    }

    public function testConstructor()
    {
        $this->assertInstanceOf(UpdateChargeCardRequest::class, $this->updateRequest);
    }

    public function testSetAndGetProperties()
    {
        // Criar objetos necessários
        $card = new CreateCardRequest();
        $card->number = '4111111111111111';
        $card->holderName = 'John Doe';
        $card->expMonth = 12;
        $card->expYear = 2025;
        $card->cvv = '123';
        
        // Definir valores para as propriedades
        $this->updateRequest->updateSubscription = true;
        $this->updateRequest->cardId = 'card_123456';
        $this->updateRequest->card = $card;
        $this->updateRequest->recurrence = false;
        
        // Verificar se os valores foram definidos corretamente
        $this->assertTrue($this->updateRequest->updateSubscription);
        $this->assertEquals('card_123456', $this->updateRequest->cardId);
        $this->assertSame($card, $this->updateRequest->card);
        $this->assertFalse($this->updateRequest->recurrence);
    }

    public function testJsonSerialize()
    {
        // Criar objetos necessários
        $card = new CreateCardRequest();
        $card->number = '4111111111111111';
        $card->holderName = 'John Doe';
        
        // Definir valores para as propriedades
        $this->updateRequest->updateSubscription = true;
        $this->updateRequest->cardId = 'card_123456';
        $this->updateRequest->card = $card;
        $this->updateRequest->recurrence = false;
        
        // Serializar o objeto para JSON
        $json = json_encode($this->updateRequest);
        $data = json_decode($json, true);
        
        // Verificar se os valores foram serializados corretamente
        $this->assertArrayHasKey('update_subscription', $data);
        $this->assertArrayHasKey('card_id', $data);
        $this->assertArrayHasKey('card', $data);
        $this->assertArrayHasKey('recurrence', $data);
        $this->assertTrue($data['update_subscription']);
        $this->assertEquals('card_123456', $data['card_id']);
        $this->assertIsArray($data['card']);
        $this->assertEquals('4111111111111111', $data['card']['number']);
        $this->assertEquals('John Doe', $data['card']['holder_name']);
        $this->assertFalse($data['recurrence']);
    }
} 