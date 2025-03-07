<?php

namespace MundiAPILib\Tests\Unit;

use MundiAPILib\MundiAPIClient;
use MundiAPILib\Controllers\SubscriptionsController;
use MundiAPILib\Controllers\OrdersController;
use MundiAPILib\Controllers\PlansController;
use MundiAPILib\Controllers\InvoicesController;
use MundiAPILib\Controllers\CustomersController;
use MundiAPILib\Controllers\ChargesController;
use MundiAPILib\Controllers\RecipientsController;
use MundiAPILib\Controllers\TokensController;
use MundiAPILib\Controllers\SellersController;
use MundiAPILib\Controllers\TransactionsController;
use MundiAPILib\Controllers\TransfersController;
use PHPUnit\Framework\TestCase;

class MundiAPIClientTest extends TestCase
{
    /**
     * @var MundiAPIClient
     */
    private $client;

    protected function setUp(): void
    {
        $this->client = new MundiAPIClient('testUser', 'testPassword', 'testReferer');
    }

    public function testGetSubscriptions()
    {
        $controller = $this->client->getSubscriptions();
        $this->assertInstanceOf(SubscriptionsController::class, $controller);
    }

    public function testGetOrders()
    {
        $controller = $this->client->getOrders();
        $this->assertInstanceOf(OrdersController::class, $controller);
    }

    public function testGetPlans()
    {
        $controller = $this->client->getPlans();
        $this->assertInstanceOf(PlansController::class, $controller);
    }

    public function testGetInvoices()
    {
        $controller = $this->client->getInvoices();
        $this->assertInstanceOf(InvoicesController::class, $controller);
    }

    public function testGetCustomers()
    {
        $controller = $this->client->getCustomers();
        $this->assertInstanceOf(CustomersController::class, $controller);
    }

    public function testGetCharges()
    {
        $controller = $this->client->getCharges();
        $this->assertInstanceOf(ChargesController::class, $controller);
    }

    public function testGetRecipients()
    {
        $controller = $this->client->getRecipients();
        $this->assertInstanceOf(RecipientsController::class, $controller);
    }

    public function testGetTokens()
    {
        $controller = $this->client->getTokens();
        $this->assertInstanceOf(TokensController::class, $controller);
    }

    public function testGetSellers()
    {
        $controller = $this->client->getSellers();
        $this->assertInstanceOf(SellersController::class, $controller);
    }

    public function testGetTransactions()
    {
        $controller = $this->client->getTransactions();
        $this->assertInstanceOf(TransactionsController::class, $controller);
    }

    public function testGetTransfers()
    {
        $controller = $this->client->getTransfers();
        $this->assertInstanceOf(TransfersController::class, $controller);
    }
} 