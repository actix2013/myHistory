<?php


namespace App\Services;


use DateTime;

class TimeCalculator
{
    public function calculateTime (DateTime $start,DateTime $end) : string
    {
        $diff = $end->diff($start);
        $nbMounth  = $diff["m"];
        $nbYear = $diff["y"];
        if($nbMounth > 0 && $nbYear > 0) {
            return $nbYear . "ans et" . $nbMounth ."mois";
        } elseif ($nbMounth === 0 && $nbYear > 0) {
            return $nbYear . "ans";
        } elseif ($nbMounth = 0 && $nbYear === 0) {
            return $nbMounth . "mois";
        }
    }

}
