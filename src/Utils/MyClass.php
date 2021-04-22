<?php

namespace App\Utils;

class MyClass
{
    public function calcul_Loyer(int $base, int $charge): int
    {
        $montant = $base + $charge;
        return ($montant);
        dd($montant);
    }
}
