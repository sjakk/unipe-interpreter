<?php

declare(strict_types=1);

namespace Unipe\Token






enum TokenType: string{

case ILLEGAL = "ILLEGAL";
case EOF = "EOF";


//Identificadores + Litarals
case IDENT = "IDENT"; //add,x,y,variaveis no geral
case INT = "INT"; //numeros inteiros


//Operadores

case ASSIGN = "=";
case PLUS = "+";


//delimitadores
case COMMA = ",";
case SEMICOLON = ";";


case LPAREN = "(";
case RPAREN = ")";
case LBRACE = "{";
case LBRACE = "}";



//palavras chaves


case FUNCTION = "FUNCTION";
case LET = "LET";
}
