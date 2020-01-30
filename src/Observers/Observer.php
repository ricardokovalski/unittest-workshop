<?php
namespace src\Observers;


class Observer
{
    public function update($argument)
    {
        // Faz algo.
    }

    public function reportError($errorCode, $errorMessage, Subject $subject)
    {
        // Faz algo.
    }

    // Outros métodos.
}