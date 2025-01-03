<?php

declare(strict_types=1);

namespace Unipe\Lexer;

use Unipe\Token\Token;
use Unipe\Token\TokenType;

final class Lexer
{
    private const EOF = '0';

    private int $size;

    private string $input;

    private Char $char;
    private Char $peekChar;

    private int $position = 0;
    private int $readPosition = 0;

    public function __construct(string $input)
    {
        $this->input = $input;
        $this->size = \mb_strlen($this->input);

        $this->char = Char::from('');
        $this->peekChar = Char::from('');

        $this->readChar();
    }

    public function nextToken(): Token
    {
        $this->skipWhitespaces();

        if ($this->char->is(self::EOF)) {
            return $this->makeTokenAndAdvance(TokenType::T_EOF, self::EOF);
        }

        if (TokenType::isSingleCharToken($this->char->toScalar())) {
            if ($this->char->is('=') && $this->peekChar->is('=')) {
                return $this->makeTwoCharTokenAndAdvance(TokenType::T_EQ);
            }

            if ($this->char->is('!') && $this->peekChar->is('=')) {
                return $this->makeTwoCharTokenAndAdvance(TokenType::T_NOT_EQ);
            }

            if ($this->char->is('>') && $this->peekChar->is('=')) {
                return $this->makeTwoCharTokenAndAdvance(TokenType::T_GT_EQ);
            }

            if ($this->char->is('<') && $this->peekChar->is('=')) {
                return $this->makeTwoCharTokenAndAdvance(TokenType::T_LT_EQ);
            }

            $tokenType = TokenType::lookupToken($this->char->toScalar());

            return $this->makeTokenAndAdvance($tokenType, $this->char->toScalar());
        }

        if ($this->char->isLetter()) {
            $identifier = $this->readIdentifier();
            return $this->makeToken(
                TokenType::lookupToken($identifier) ?? TokenType::T_IDENT,
                $identifier
            );
        }

        if ($this->char->isDigit()) {
            return $this->makeToken(TokenType::T_INT, $this->readNumber());
        }

        return $this->makeTokenAndAdvance(TokenType::T_ILLEGAL, $this->char->toScalar());
    }

    private function readIdentifier(): string
    {
        $position = $this->position;
        while ($this->char->isLetter()) {
            $this->readChar();
        }

        return \mb_substr($this->input, $position, $this->position - $position);
    }

    private function readChar(): void
    {
        if ($this->isEnd()) {
            $this->char = Char::from(self::EOF);
        } else {
            $this->char = Char::from($this->input[$this->readPosition]);
        }

        $this->position = $this->readPosition;
        ++$this->readPosition;

        if (!$this->isEnd()) {
            $this->peekChar = Char::from($this->input[$this->readPosition]);
        }
    }

    private function readNumber(): string
    {
        $position = $this->position;
        while ($this->char->isDigit()) {
            $this->readChar();
        }

        return \mb_substr($this->input, $position, $this->position - $position);
    }

    private function skipWhitespaces(): void
    {
        while ($this->char->isWhitespace()) {
            $this->readChar();
        }
    }

    public function isEnd(): bool
    {
        return $this->readPosition >= $this->size;
    }

    private function makeTokenAndAdvance(int $type, string $literal): Token
    {
        $this->readChar();
        return $this->makeToken($type, $literal);
    }

    private function makeTwoCharTokenAndAdvance(int $type): Token
    {
        $char = $this->char;
        $this->readChar();
        $token = $this->makeToken($type, "{$char->toScalar()}{$this->char->toScalar()}");
        $this->readChar();
        return $token;
    }

    private function makeToken(int $type, string $literal): Token
    {
        return new Token($type, $literal);
    }
}
