<?php


namespace App\Services;


use DateTime;

class TimeCalculator
{
    public function calculateTime (DateTime $start,DateTime $end) : string
    {
        $diff = $end->diff($start);
        $nbMounth  = $diff->m;
        $nbYear = $diff->y;
        if($nbMounth > 0 && $nbYear > 0) {
            return $nbYear . " ans et " . $nbMounth ." mois";
        }
        if ($nbMounth === 0 && $nbYear > 0) {
            return $nbYear . " ans";
        }
        if ($nbMounth > 0 && $nbYear == 0) {
            return $nbMounth . " mois";
        }
        return "error";
    }

}
