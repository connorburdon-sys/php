<?php
Class Zaal {
    public int $nummer;
    public int$aantalStoelen;
    public bool $isMAX;

   public function __construct( int $nummer, int $aantalStoelen, bool $isMAX ) {
       $this -> nummer = $nummer;
       $this -> aantalStoelen = $aantalStoelen;
       $this -> isMAX = $isMAX;
   }
   public function getZaalnaam():string {
        if($this -> isMAX) {
            return "IMAX Zaal " . $this -> nummer;
        } else {
            return "Zaal " . $this -> nummer;
        }
    }
}