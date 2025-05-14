<?php

require_once 'menu.php';
require_once 'game.php';
require_once 'history.php';
require_once 'stats.php';

while (true) {
    showMenu();
    $choice = trim(fgets(STDIN));

    if (!in_array($choice, ['1', '2', '3', '4'])) {
        echo "Choix invalide, réessayez.\n";
        continue;
    }

    switch ($choice) {
        case '1':
            playGame();
            break;
        case '2':
            showHistory();
            break;
        case '3':
            showStats();
            break;
        case '4':
            echo "Au revoir !\n";
            exit;
    }
}
