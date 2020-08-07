<?php

namespace App\Services;

class TimeCalculator
{
    public function calculateTime(?\DateTimeInterface $start, ?\DateTimeInterface $end): string
    {
        $nbMounth = 0;
        $nbYear = 0;
        if ($start && $end) {
            $diff = $end->diff($start);
            $nbMounth = $diff->m;
            $nbYear = $diff->y;
        }
        if ($nbMounth > 0 && $nbYear > 0) {
            return $nbYear.' ans et '.$nbMounth.' mois';
        }
        if (0 === $nbMounth && $nbYear > 0) {
            return $nbYear.' ans';
        }
        if ($nbMounth > 0 && 0 == $nbYear) {
            return $nbMounth.' mois';
        }

        return 'error';
    }
}
