<?php

require 'vendor/autoload.php';

use App\Database\Connection;
use App\Repository\TranslationRepository;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $languageId = $_POST['language'];
    $phrase = $_POST['phrase'];

    $connection = Connection::getInstance()->getPdo();
    $repository = new TranslationRepository($connection);

    $translation = $repository->findForLanguage($languageId, $phrase);

    if ($translation) {
        echo "Translation: " . $translation;
    } else {
        echo "No translation found for the given phrase.";
    }
}
?>
