<?php


declare(strict_types=1);

namespace Unipe\Lexer;

use Unipe\Token\TokenType;
use Unipe\Token\Token;

final class Lexer{

public const EOF = "\0";

public readonly string $input;


public int $position = 0;
public int $readPosition = 0;

}





