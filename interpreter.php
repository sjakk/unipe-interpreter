<?php

declare(strict_types=1);


namespace Unipe;


require 'vendor/autoload.php';

use Unipe\Repl\Repl;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sourceCode = $_POST['source_code'] ?? '';
    if (!empty($sourceCode)) {
        try {
	    require_once 'src/unipe.php'; 
	    require_once 'src/Repl/Repl.php';
            	//$interpreter = new MyInterpreter();
		$rep = new Repl();
		//$output = $interpreter->run($sourceCode);  
	    	$output = $rep->start_web($sourceCode);
	   	echo nl2br($output);
	 } catch (Throwable $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "No code provided.";
    }
} else {
    echo "Invalid request method.";
}

?>
