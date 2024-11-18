<?php
declare(strict_types=1);


namespace Unipe\Token;


final readonly class Token{
	public function __construct(
		public TokenType $type,
		public string $literal,
){}

}
