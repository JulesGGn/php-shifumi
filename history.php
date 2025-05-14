<?php

function loadHistory()
{
    if (!file_exists('history.json')) return [];
    return json_decode(file_get_contents('history.json'), true);
}

function saveHistory($history)
{
    file_put_contents('history.json', json_encode($history, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function showHistory()
{
    $history = loadHistory();
    if (empty($history)) {
        echo "\nAucune partie enregistrée.\n";
        return;
    }

    echo "\n=== Historique des Parties ===\n";
    printf("%-20s %-10s %-10s %-10s\n", 'Date', 'Joueur', 'CPU', 'Résultat');
    foreach ($history as $entry) {
        printf("%-20s %-10s %-10s %-10s\n", $entry['date'], $entry['joueur'], $entry['cpu'], $entry['résultat']);
    }
}
