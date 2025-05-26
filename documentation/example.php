<?php
require_once 'Processor.php';

// Create a document processor
$processor = new DocumentProcessor();

// Sample document
$document = "
    THIS is a    SAMPLE document
      with inconsistent spacing
    and MIXED case text.
        It also has some  indentation   issues.
";

// Process the document
$normalizedDocument = $processor->process($document);

// Display results
echo "Original document:\n";
echo str_repeat('-', 40) . "\n";
echo $document . "\n";
echo str_repeat('-', 40) . "\n";
echo "\nNormalized document:\n";
echo str_repeat('-', 40) . "\n";
echo $normalizedDocument . "\n";
echo str_repeat('-', 40) . "\n";
?>
