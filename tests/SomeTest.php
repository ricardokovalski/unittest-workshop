<?php

use PHPUnit\Framework\TestCase;
use src\Basic\SomeClass;

class SomeTest extends TestCase
{
    public function testStub()
    {
        // Cria um esboço para a classe SomeClass.
        // $stub = $this->createMock(SomeClass::class);
        $stub = $this->getMock(SomeClass::class);

        // Configura o esboço.
        $stub->method('doSomething')
            ->willReturn('foo');

        // Chamando $stub->doSomething() agora vai retornar
        // 'foo'.
        $this->assertEquals('foo', $stub->doSomething());
    }

    public function testStub2()
    {
        // Cria um esboço para a classe SomeClass.
        $stub = $this->getMockBuilder(SomeClass::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            //->disallowMockingUnknownTypes()
            ->getMock();

        // Configura o esboço.
        $stub->method('doSomething')
            ->willReturn('foo');

        // Chamar $stub->doSomething() agora irá retornar
        // 'foo'.
        $this->assertEquals('foo', $stub->doSomething());
    }

    public function testReturnSelf()
    {
        // Cria um esboço para a classe SomeClass.
        $stub = $this->getMock(SomeClass::class);

        // Configura o esboço.
        $stub->method('doSomething')
            ->will($this->returnSelf());

        // $stub->doSomething() retorna $stub
        $this->assertSame($stub, $stub->doSomething());
    }

    public function testReturnValueMapStub()
    {
        // Cria um esboço para a classe SomeClass.
        $stub = $this->getMock(SomeClass::class);

        // Cria um mapa de argumentos para valores retornados.
        $map = [
            ['a', 'b', 'c', 'd'],
            ['e', 'f', 'g', 'h']
        ];

        // Configura o esboço.
        $stub->method('doSomething')
            ->will($this->returnValueMap($map));

        // $stub->doSomething() retorna diferentes valores dependendo do
        // argumento fornecido.
        $this->assertEquals('d', $stub->doSomething('a', 'b', 'c'));
        $this->assertEquals('h', $stub->doSomething('e', 'f', 'g'));
    }

    public function testReturnCallbackStub()
    {
        // Cria um esboço para a classe SomeClass.
        $stub = $this->getMock(SomeClass::class);

        // Configura o esboço.
        $stub->method('doSomething')
            ->will($this->returnCallback('str_rot13'));

        // $stub->doSomething($argument) retorna str_rot13($argument)
        $this->assertEquals('fbzrguvat', $stub->doSomething('something'));
    }

    public function testOnConsecutiveCallsStub()
    {
        // Cria um esboço para a classe SomeClass.
        $stub = $this->getMock(SomeClass::class);

        // Configura o esboço.
        $stub->method('doSomething')
            ->will($this->onConsecutiveCalls(2, 3, 5, 7));

        // $stub->doSomething() retorna um valor diferente a cada vez
        $this->assertEquals(2, $stub->doSomething());
        $this->assertEquals(3, $stub->doSomething());
        $this->assertEquals(5, $stub->doSomething());
    }

    public function testThrowExceptionStub()
    {
        // Cria um esboço para a classe SomeClass.
        $stub = $this->getMock(SomeClass::class);

        // Configura o esboço.
        $stub->method('doSomething')
            ->will($this->throwException(new Exception));

        // Espera que seja lançado a exception
        $this->setExpectedException(Exception::class);

        // $stub->doSomething() lança Exceção
        $stub->doSomething();
    }

    public function testFunctionCalledTwoTimesWithSpecificArguments()
    {
        $mock = $this->getMockBuilder(stdClass::class)
            ->setMethods(['set'])
            ->getMock();

        $mock->expects($this->exactly(2))
            ->method('set')
            ->withConsecutive(
                [$this->equalTo('foo'), $this->greaterThan(0)],
                [$this->equalTo('bar'), $this->greaterThan(0)]
            );

        $mock->set('foo', 21);
        $mock->set('bar', 48);
    }

    public function testIdenticalObjectPassed()
    {
        $expectedObject = new stdClass;

        $mock = $this->getMockBuilder(stdClass::class)
            ->setMethods(['foo'])
            ->getMock();

        $mock->expects($this->once())
            ->method('foo')
            ->with($this->identicalTo($expectedObject));

        $mock->foo($expectedObject);
    }
}