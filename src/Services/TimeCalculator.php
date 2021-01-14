<?php

namespace App\Services;

class TimeCalculator
{
    public function calculateTime(?\DateTimeInterface $start, ?\DateTimeInterface $end): string
    {
        $nbMonth = 0;
        $nbYear = 0;

        if ($start && $end) {
            $diff = $end->diff($start);
            $nbMonth = $diff->m;
            $nbYear = $diff->y;
        }
        if ($nbMonth > 0 && $nbYear > 0) {
            return $nbYear.' ans et '.$nbMonth.' mois';
        }
        if (0 === $nbMonth && $nbYear > 0) {
            return $nbYear.' ans';
        }
        if ($nbMonth > 0 && 0 == $nbYear) {
            return $nbMonth.' mois';
        }

        return 'error';
    }
}
