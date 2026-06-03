<?php

declare(strict_types=1);


// Laad jouw klassen (pas de paden aan als nodig)

require 'film.php';

require 'zaal.php';

require 'voorstelling.php';

require 'ticket.php';


// ── Stap 1: Films aanmaken ──────────────────────────────────────

$inception = new Film("Inception", "Christopher Nolan", 148, 12);

$deadpool = new Film("Deadpool 3", "Shawn Levy", 127, 16);


// ── Stap 2: Zalen aanmaken ──────────────────────────────────────

$zaakIMAX = new Zaal(1, 120, true); // IMAX Zaal 1, 120 stoelen

$zaalNormaal = new Zaal(2, 80, false); // Zaal 2, 80 stoelen


// ── Stap 3: Voorstellingen plannen ─────────────────────────────

$avondfilm = new Voorstelling($inception, $zaakIMAX, "2025-03-07", "20:00",

14.50);

$middag = new Voorstelling($deadpool, $zaalNormaal, "2025-03-07", "15:00",

11.00);


// ── Stap 4: Kaartjes verkopen ───────────────────────────────────

$t1 = $avondfilm->verkoopTicket("Lisa");

$t2 = $avondfilm->verkoopTicket("Tom");

$t3 = $avondfilm->verkoopTicket("Sara");

$t4 = $middag->verkoopTicket("Mark");


// ── Stap 5: Uitvoer ────────────────────────────────────────────

echo "=== FILMS ===" . PHP_EOL;

echo $inception->getSamenvatting() . PHP_EOL;

echo $deadpool->getSamenvatting() . PHP_EOL;


echo PHP_EOL . "=== ZALEN ===" . PHP_EOL;

echo $zaakIMAX->getZaalnaam() . PHP_EOL; // IMAX Zaal 1

echo $zaalNormaal->getZaalnaam() . PHP_EOL; // Zaal 2


echo PHP_EOL . "=== VOORSTELLINGEN ===" . PHP_EOL;

echo $avondfilm->getResterendePlaatsen() . ' plaatsen over' . PHP_EOL; // 117

echo 'Vol? ' . ($avondfilm->isVol() ? 'Ja' : 'Nee') . PHP_EOL; // Nee

echo 'Inkomsten: EUR ' . $avondfilm->getInkomsten() . PHP_EOL; // 43.5


echo PHP_EOL . "=== TICKETS ===" . PHP_EOL;

echo $t1->getBevestiging() . PHP_EOL;

echo $t2->getBevestiging() . PHP_EOL;

echo $t3->getBevestiging() . PHP_EOL;


echo PHP_EOL . "=== LEEFTIJDSCHECK ===" . PHP_EOL;

echo $inception->isGeschiktVoor(15) ? 'Geschikt' : 'Niet geschikt'; // Geschikt

echo PHP_EOL;

echo $deadpool->isGeschiktVoor(14) ? 'Geschikt' : 'Niet geschikt'; // Niet


echo PHP_EOL;


echo PHP_EOL . "=== FILMDUUR ===" . PHP_EOL;

echo $inception->getDuurAlsString() . PHP_EOL; // 2 uur en 28 minuten

echo $deadpool->getDuurAlsString() . PHP_EOL; // 2 uur en 7 minuten