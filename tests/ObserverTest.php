<?php

use PHPUnit\Framework\TestCase;
use src\Observers\Observer;
use src\Observers\Subject;

class ObserverTest extends TestCase
{
    public function testObserversAreUpdated()
    {
        // Cria uma falsificação para a classe Observer,
        // apenas falsificando o método update().

        $observer = $this->getMockBuilder(Observer::class)
            ->setMethods(['update'])
            ->getMock();

        // Configura a expectativa para o método update()
        // para ser chamado apenas uma vez e com a string 'something'
        // como seu parâmetro.
        $observer->expects($this->once())
            ->method('update')
            ->with($this->equalTo('something'));

        // Cria um objeto Subject e anexa a ele o objeto
        // Observer falsificado.
        $subject = new Subject('My subject');
        $subject->attach($observer);

        // Chama o método doSomething() no objeto $subject
        // no qual esperamos chamar o método update()
        // do objeto falsificado Observer, com a string 'something'.
        $subject->doSomething();
    }

    public function testErrorReported()
    {
        // Cria um mock para a classe Observer, falsificando o
        // método reportError()
        $observer = $this->getMockBuilder(Observer::class)
            ->setMethods(['reportError'])
            ->getMock();

        // with envia os requisitos de parametros esperados na função
        $observer->expects($this->once())
            ->method('reportError')
            ->with(
                $this->greaterThan(0),
                $this->stringContains('Something'),
                $this->anything()
            );

        $subject = new Subject('My subject');
        $subject->attach($observer);

        // O método doSomethingBad() deve reportar um erro ao observer
        // através do método reportError()
        $subject->doSomethingBad();
    }

    public function testErrorReportedTwo()
    {
        // Cria um mock para a classe Observer, falsificando o
        // método reportError()
        $observer = $this->getMockBuilder(Observer::class)
            ->setMethods(['reportError'])
            ->getMock();

        // espera que a chamada do método reportError receba os parametros com requisitos
        // onde o ultimo é uma chamada para o método do objeto que será criado e
        // fará o attach do observer em questão, validando ainda dessa forma o método do objeto subject
        $observer->expects($this->once())
            ->method('reportError')
            ->with($this->greaterThan(0),
                $this->stringContains('Something'),
                $this->callback(function($subject){
                    return is_callable([$subject, 'getName']) and
                        $subject->getName() == 'My subject';
                }));

        $subject = new Subject('My subject');
        $subject->attach($observer);

        // O método doSomethingBad() deve reportar um erro ao observer
        // através do método reportError()
        $subject->doSomethingBad();
    }

    public function testObserversAreUpdatedWithProphecy()
    {
        $subject = new Subject('My subject');

        // Cria uma profecia para a classe Observer.
        $observer = $this->prophesize(Observer::class);

        // Configura a expectativa para o método update()
        // para que seja chamado somente uma vez e com a string 'something'
        // como parâmetro.
        $observer->update('something')->shouldBeCalled();

        // Revela a profecia e anexa o objeto falsificado
        // ao Subject.
        $subject->attach($observer->reveal());

        // Chama o método doSomething() no objeto $subject
        // que esperamos que chame o método update() do objeto
        // Observer falsificado com a string 'something'.
        $subject->doSomething();
    }
}