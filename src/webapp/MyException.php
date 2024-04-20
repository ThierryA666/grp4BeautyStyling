<?php

namespace beautyStyling\webapp;

class MyExceptionCase {
    const EMAIL_DOUBLON = 'EMAIL_DOUBLON';
    const SALON_USE = 'SALON_USE';
    
}

class MyException extends \Exception {
    function __construct($case){
        parent::__construct($this->getErrorMessage($case), $this->getErrorCode($case));
    }

    private function getErrorMessage($case) {
        return match($case) {
            
            MyExceptionCase::SALON_USE              => "Ce salon est utilisée. Vous ne pouvez le supprimer.",            
            MyExceptionCase::EMAIL_DOUBLON          => "Cet email est déjà existe",
            
            default => "Unknown error",
        };
    }

    private function getErrorCode($case) {
        return match($case) {
                       
            MyExceptionCase::SALON_USE              => 402,            
            MyExceptionCase::EMAIL_DOUBLON          => 800,
            
            default => 0,
        };
    }
}