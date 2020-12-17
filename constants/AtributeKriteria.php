<?php

class AtributeKriteria
{
    const BENEFIT = 1;
    const COST = 2;

    public static function labels()
    {
        return [
            'Benefit' => self::BENEFIT,
            'Cost' => self::COST,
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