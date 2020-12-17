<?php

class Kriteria
{
    const JENIS_PICKUP = 1;
    const JENIS_KAYU = 2;
    const HARGA = 3;
    const MERK = 4;

    public static function labels()
    {
        return [
            'Jenis Pickup' => self::JENIS_PICKUP,
            'Jenis Kayu' => self::JENIS_KAYU,
            'Harga' => self::HARGA,
            'Merek' => self::MERK,
        ];
    }

    public static function label($id = null)
    {   
        if($id != null || $id != 0)
            return array_search($id, self::labels());
        else
            return "-"; 
    }
}