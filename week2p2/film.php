<?php
Class Film {
    public readonly string $title;
    public readonly string $regisseur;
    public readonly int $duurInMinuten;
    public readonly int $leeftijdsgrens;

  public function __construct( string $title, string $regisseur, int $duurInMinuten, int $leeftijdsgrens) {
        $this -> title = $title;
        $this -> regisseur = $regisseur;
        $this -> duurInMinuten = $duurInMinuten;
        $this -> leeftijdsgrens = $leeftijdsgrens;
    }
    public function getDuurAlsString(): string {
        $aantalUur= floor($this -> duurInMinuten / 60);
        $aantalMin= $this -> duurInMinuten % 60;
        return $aantalUur . " uur en " . $aantalMin . " minuten";
    }

    public function isGeschiktVoor(int $leeftijd): bool {
    if($leeftijd >= $this -> leeftijdsgrens) {
        return true;
    } else {
        return false;
    }}
    public function getSamenvatting(): string {
        return $this -> title . " (" . $this -> regisseur . ", " . $this -> duurInMinuten . " minuten)" . $this -> leeftijdsgrens . "+";
    }
}