<?php

namespace MundiAPILib\Tests\Unit;

use MundiAPILib\Configuration;
use PHPUnit\Framework\TestCase;

class ConfigurationTest extends TestCase
{
    private $originalBasicAuthUserName;
    private $originalBasicAuthPassword;
    private $originalServiceRefererName;
    
    protected function setUp(): void
    {
        // Salvar os valores originais
        $this->originalBasicAuthUserName = Configuration::$basicAuthUserName;
        $this->originalBasicAuthPassword = Configuration::$basicAuthPassword;
        $this->originalServiceRefererName = Configuration::$serviceRefererName;
    }
    
    protected function tearDown(): void
    {
        // Restaurar os valores originais
        Configuration::$basicAuthUserName = $this->originalBasicAuthUserName;
        Configuration::$basicAuthPassword = $this->originalBasicAuthPassword;
        Configuration::$serviceRefererName = $this->originalServiceRefererName;
    }
    
    public function testDefaultValues()
    {
        // Verificar valores padrão
        $this->assertEquals('TODO: Replace', Configuration::$basicAuthUserName);
        $this->assertEquals('TODO: Replace', Configuration::$basicAuthPassword);
        $this->assertEquals('', Configuration::$serviceRefererName);
    }
    
    public function testSetValues()
    {
        // Definir valores
        Configuration::$basicAuthUserName = 'testUser';
        Configuration::$basicAuthPassword = 'testPassword';
        Configuration::$serviceRefererName = 'testReferer';
        
        // Verificar se os valores foram definidos corretamente
        $this->assertEquals('testUser', Configuration::$basicAuthUserName);
        $this->assertEquals('testPassword', Configuration::$basicAuthPassword);
        $this->assertEquals('testReferer', Configuration::$serviceRefererName);
    }
} 