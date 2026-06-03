<?php

class Ticket {
    public readonly Voorstelling $voorstelling;
    public readonly string $naam;
    public readonly int $ticketnummer;


    public function __construct( Voorstelling $voorstelling, string $naam, int $ticketnummer) {
        $this->voorstelling = $voorstelling;
        $this->naam = $naam;
        $this->ticketnummer = $ticketnummer;
    }
    public function getPrijs(): float {
            return $this->voorstelling->getPrijs();
    }
    public function getBevestiging(): string {
        return "Ticket #" . $this->ticketnummer . " voor " . $this->voorstelling->film->title . " op " . $this->voorstelling->datum . " om " . $this->voorstelling->tijd . " - Gekocht door: " . $this->naam;
    }
}



