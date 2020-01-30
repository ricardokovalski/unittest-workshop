<?php

namespace src;


class Util
{
    // by Martin Fowler https://www.martinfowler.com/articles/mocksArentStubs.html

    /*
     * Dummy objects
     * en: Dummy objects are passed around but never actually used. Usually they are just used to fill parameter lists.
     * pt-BR: Objetos fictícios "Dummy" são passados, mas nunca são realmente usados.
     * Geralmente eles são usados ​​apenas para preencher listas de parâmetros.
     *
     *
     *
     * Stubs objects
     * en: Stubs provide canned answers to calls made during the test, usually not responding at all to
     * anything outside what's programmed in for the test.
     * pt-BR: Os stubs fornecem respostas prontas para as chamadas feitas durante o teste,
     * geralmente não respondendo a nada fora do que está programado para o teste.
     *
     *
     *
     * Fake objects
     * en: Fake objects actually have working implementations, but usually take some shortcut which
     * makes them not suitable for production (an in memory database is a good example).
     * pt-BR: Objetos falsos "Fakes" realmente têm implementações de trabalho, mas geralmente usam algum atalho que os
     * torna inadequados para produção (um banco de dados na memória é um bom exemplo).
     *
     *
     *
     * Spies objects
     * en: Spies are stubs that also record some information based on how they were called.
     * One form of this might be an email service that records how many messages it was sent.
     * pt-BR: Espiões são stubs que também registram algumas informações com base em como foram chamadas.
     * Uma forma disso pode ser um serviço de email que registra quantas mensagens foram enviadas.
     *
     *
     *
     * Mock objects
     * en: Mocks are objects pre-programmed with expectations which form a
     * specification of the calls they are expected to receive.
     * pt-BR: Dubles são objetos pré-programados com expectativas que formam uma especificação das
     * chamadas que eles devem receber.
     *
     */
}