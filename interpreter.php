<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sourceCode = $_POST['source_code'] ?? '';
    if (!empty($sourceCode)) {
        try {
            require_once 'src/unipe.php'; 
            $interpreter = new MyInterpreter();

	    $output = $interpreter->run($sourceCode);  
	   echo $output;
	 } catch (Throwable $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "No code provided.";
    }
} else {
    echo "Invalid request method.";
}

