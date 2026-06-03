<?php
class Voorstelling {
    public readonly Film $film;
    public readonly Zaal $zaal;
    public readonly string $datum;
    public readonly string $tijd;
    public readonly float $ticketprijs;
    private array $tickets = [];

    public  function __construct( Film $film, Zaal $zaal, string $datum, string $tijd, float $ticketprijs) {
        $this->film = $film;
        $this->zaal = $zaal;
        $this->datum = $datum;
        $this->tijd = $tijd;
        $this->ticketprijs = $ticketprijs;
    }

   public function verkoopTicket(string $naam) : Ticket {
    if($this -> isVol()) {
        throw new Exception("Voorstelling is vol. Kan geen ticket verkopen.");
    }
    $ticketnummer = count($this -> tickets) + 1;
    $ticket = new Ticket($this, $naam, $ticketnummer);
    $this -> tickets[] = $ticket;
    return $ticket;
   }

   public function getResterendePlaatsen() : int {
    return $this -> zaal -> aantalStoelen - count($this -> tickets);
   }

   public function isVol() : bool {
    if($this -> getResterendePlaatsen() <= 0) {
        return true;
    } else {
        return false;
    }
   }

   public function getInkomsten() : float {
    return count($this -> tickets) * $this -> ticketprijs;
   }
   public function getTicketaAantal() : int {
    return count($this -> tickets);
   }

}