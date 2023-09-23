<?php
    $stopWords = array(
        "the", "and", "in", "of", "to", "a", "is", "it", "you", "that", "he", "she", "we", "they",
        "for", "on", "with", "as", "an", "at", "by", "from", "but", "or", "not", "this", "are"
    );
    function tokenizeText($text) {

        return str_word_count($text, 1);
    }
    function calculateWordFrequencies($words) {
        global $stopWords;
        $filteredWords = array_diff($words, $stopWords);
        return array_count_values($filteredWords);
    }
    function sortWordFrequencies($wordFrequencies, $sortOrder) {
        if ($sortOrder === "asc") {
            asort($wordFrequencies);
        } else {
            arsort($wordFrequencies);
        }
        return $wordFrequencies;
    }
    function limitWordFrequencies($wordFrequencies, $displayLimit) {
        return array_slice($wordFrequencies, 0, $displayLimit);
    }

    $inputText = $_POST["text"];
    $sortOrder = $_POST["sort"];
    $displayLimit = $_POST["limit"];

    $words = tokenizeText($inputText);
    $wordFrequencies = calculateWordFrequencies($words);
    $sortedWordFrequencies = sortWordFrequencies($wordFrequencies, $sortOrder);
    $limitedWordFrequencies = limitWordFrequencies($sortedWordFrequencies, $displayLimit);

    echo "<h2>Word Frequencies:</h2>";
    echo "<table>";
    echo "<tr><th>Word</th><th>Frequency</th></tr>";
    foreach ($limitedWordFrequencies as $word => $frequency) {
        echo "<tr><td>$word</td><td>$frequency</td></tr>";
    }
    echo "</table>";
?>
