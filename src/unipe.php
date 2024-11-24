<?php
declare(strict_types=1);

namespace Unipe;


require './vendor/autoload.php';

use Unipe\Repl\Repl;


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
	//help();
}



class MyInterpreter {
    public function run(string $code): string {
                if (trim($code) === 'print("Hello, World!")') {
            return "Hello, World!";
        }

        return "Unknown command: " . htmlspecialchars($code);
    }
}

?>


