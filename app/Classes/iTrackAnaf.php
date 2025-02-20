<?php

namespace App\Classes;

class iTrackAnaf
{
    public static function fetch($cif)
    {
        $anaf = new \Itrack\Anaf\Client();
        $anaf->addCif($cif, now()->format('Y-m-d'));
        $company = $anaf->first();

        return [
            'name' => $company->getName(),
            'cui' => $company->getCIF(),
            'reg_com' => $company->getRegCom(),
            'phone' => $company->getPhone(),
            'office_address' => $company->getFullAddress(),
            'vat' => $company->getTVA()->hasTVA(),
        ];
    }
}
