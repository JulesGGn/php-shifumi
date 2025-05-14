<?php
require_once 'history.php';

function playGame()
{
    $choices = ['pierre', 'feuille', 'ciseau'];

    while (true) {
        echo "\nChoisissez : pierre, feuille, ciseau (ou 'annuler' pour revenir au menu) : ";
        $userInput = trim(fgets(STDIN));

        if ($userInput === 'annuler') return;

        if (!in_array($userInput, $choices)) {
            echo "Choix invalide, réessayez.\n";
            continue;
        }

        $cpuChoice = $choices[array_rand($choices)];
        echo "CPU a choisi : $cpuChoice\n";

        $result = ($userInput === $cpuChoice) ? 'égalité' :
                  ((($userInput === 'pierre' && $cpuChoice === 'ciseau') ||
                   ($userInput === 'feuille' && $cpuChoice === 'pierre') ||
                   ($userInput === 'ciseau' && $cpuChoice === 'feuille')) ? 'gagné' : 'perdu');

        echo "Résultat : Vous avez $result !\n";

        $history = loadHistory();
        $history[] = [
            'date' => date('Y-m-d H:i:s'),
            'joueur' => $userInput,
            'cpu' => $cpuChoice,
            'résultat' => $result
        ];
        saveHistory($history);

        while (true) {
            echo "\nVoulez-vous :\n1. Retourner au menu principal\n2. Lancer une nouvelle partie\nChoix : ";
            $nextChoice = trim(fgets(STDIN));
            if ($nextChoice === '1') return;
            elseif ($nextChoice === '2') break;
            else echo "Choix invalide, réessayez.\n";
        }
    }
}
