<?php
use PHPUnit\Framework\TestCase;

class InvalidTest extends TestCase
{
    protected function setUp()
    {
        if (! extension_loaded('mysqli')) {
            $this->markTestSkipped(
                'The MySQLi extension is not available.'
            );
        }
    }

    public function testConnection()
    {
        if (! extension_loaded('mysqlii')) {
            $this->markTestSkipped(
                'The MySQLi extension is not available.'
            );
        }
        //não vai exibir o teste pois a extensão não está carregada
        echo 'teste';
    }

    public function testSomething()
    {
        // Opcional: Teste alguma coisa aqui, se quiser.
        $this->assertTrue(true, 'This should already work.');

        // Pare aqui e marque este teste como incompleto.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @requires PHP 7.1-dev
     * @requires extension redis 2.2.0
     * @requires function ReflectionMethod::setAccessible
     * @requires PHPUnit 4.6
     */
    public function testVersion()
    {
        // O Teste requer PHP >= 7.1-dev, extensão redis 2.2.0, função setAccessible da classe ReflectionMethod e PHPUnit >= 4.6
    }
}