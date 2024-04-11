<?php
declare(strict_types=1);
namespace beautyStyling\tests;

enum Message {
    case CategorieInvalide;
    case PlatInvalide;

    public function getMessage(): string {
        return match($this) {
            self::CategorieInvalide => 'Cette categorie est inexistante',
            self::PlatInvalide      => 'Ce plat est inexistant',

            // Suit::Clubs, Suit::Spades => 'Black',
        };
    }

    public function getCode(): int {
        return match($this) {
            self::CategorieInvalide => 8001,
            self::PlatInvalide => 8002,
        };
    }
    
}