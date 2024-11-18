<?php
declare(strict_types=1);

namespace Unipe;



function help(): never{

echo <<<HELP
	USAGE: unipe [command]
	
	Commands:
		repl
			roda no ao vivo
		run file.unp
			roda no arquivo
		help
			instrucoes
	HELP;
	exit;
}


if($argc <=  1){
	help();
}









