<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 11.04.15
 * Time: 9:31
 */

class Otziv extends Eloquent {

    protected $softDelete = true;
    protected $table = 'otzivi';



    //Получение числа заявок для статистики в шапке
    public static function getOtzivCount(){
        $result = Cache::remember('getOtzivCount', Helper::cacheTime(), function () {
            return Otziv::all()->count();
        });
        return $result;
    }
}