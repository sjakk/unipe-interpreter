<?php

declare(strict_types=1);

namespace Unipe\Repl;




use Unipe\Lexer\Lexer;
use Unipe\Token\TokenType;


final class Repl
{
    public function start(): void
    {
        \fwrite(\STDOUT, "----------------------------------------------\n");
        \fwrite(\STDOUT, "| Welcome to the Unipe Programming Language |\n");
        \fwrite(\STDOUT, "----------------------------------------------\n");

        while (true) {
            $input = \trim(\fgets(\STDIN));
            if (':q' === $input) {
                return;
            }

            $lexer = new Lexer($input);
            while (!$lexer->isEnd()) {
                $token = $lexer->nextToken();
                //$name = TokenType::tokenName($token->type);
                \fwrite(\STDOUT, "[{$token->type}, {$token->literal}]");
            }
        }
    }



public function start_web(string $input):string{
		
	$output = "----------------------------------------------\n";
        $output .= "| Welcome to the Unipe Programming Language |\n";
        $output .= "----------------------------------------------\n";

        $lexer = new Lexer($input);
        while (!$lexer->isEnd()) {
            $token = $lexer->nextToken();
            $output .= "[{$token->type}, {$token->literal}]\n";
        }

        return $output;
    }

}// class Repl
