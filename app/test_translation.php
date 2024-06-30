<?php

require 'vendor/autoload.php';

use App\Database\Connection;
use App\Repository\TranslationRepository;

if (php_sapi_name() == 'cli') {
    // CLI mode
    $languageId = $argv[1];
    $phrase = $argv[2];
} else {
    // Web mode
    $languageId = $_POST['language'];
    $phrase = $_POST['phrase'];
}

$connection = Connection::getInstance()->getPdo();
$repository = new TranslationRepository($connection);

$translation = $repository->findForLanguage($languageId, $phrase);

if ($translation) {
    echo "Translation: " . $translation;
} else {
    echo "No translation found for the given phrase.";
}
