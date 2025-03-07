<?php

namespace MundiAPILib\Tests\Unit;

use MundiAPILib\APIHelper;
use PHPUnit\Framework\TestCase;

class APIHelperTest extends TestCase
{
    public function testAppendUrlWithTemplateParameters()
    {
        $url = 'https://api.example.com/{param1}/resource/{param2}';
        $parameters = [
            'param1' => 'value1',
            'param2' => 'value2'
        ];
        
        $result = APIHelper::appendUrlWithTemplateParameters($url, $parameters);
        $this->assertEquals('https://api.example.com/value1/resource/value2', $result);
    }
    
    public function testAppendUrlWithQueryParameters()
    {
        $url = 'https://api.example.com/resource';
        $parameters = [
            'param1' => 'value1',
            'param2' => 'value2'
        ];
        
        APIHelper::appendUrlWithQueryParameters($url, $parameters);
        $this->assertEquals('https://api.example.com/resource?param1=value1&param2=value2', $url);
    }
    
    public function testCleanUrl()
    {
        $url = 'https://api.example.com/resource//with///extra/slashes/';
        $result = APIHelper::cleanUrl($url);
        $this->assertEquals('https://api.example.com/resource/with/extra/slashes/', $result);
    }
    
    public function testDeserialize()
    {
        $json = '{"property1":"value1","property2":"value2"}';
        $result = APIHelper::deserialize($json);
        
        $this->assertIsArray($result);
        $this->assertEquals('value1', $result['property1']);
        $this->assertEquals('value2', $result['property2']);
    }
} 