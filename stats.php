<?php
require_once 'history.php';

function showStats()
{
    $history = loadHistory();
    if (empty($history)) {
        echo "\nAucune partie enregistrée.\n";
        return;
    }

    $total = count($history);
    $wins = count(array_filter($history, fn($h) => $h['résultat'] === 'gagné'));
    $winRate = $total ? round(($wins / $total) * 100, 2) : 0;

    $handWins = ['pierre' => 0, 'feuille' => 0, 'ciseau' => 0];
    $handCounts = ['pierre' => 0, 'feuille' => 0, 'ciseau' => 0];

    foreach ($history as $h) {
        $handCounts[$h['joueur']]++;
        if ($h['résultat'] === 'gagné') $handWins[$h['joueur']]++;
    }

    arsort($handWins);
    $bestHand = key($handWins);

    echo "\n=== Statistiques ===\n";
    echo "Nombre de parties jouées : $total\n";
    echo "Taux de victoire : $winRate%\n";
    echo "Main la plus gagnante : $bestHand\n";
    echo "Détails par main :\n";
    foreach ($handCounts as $hand => $count) {
        $rate = $count ? round(($handWins[$hand] / $count) * 100, 2) : 0;
        echo "  $hand : $rate% victoires\n";
    }
}
