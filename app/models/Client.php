<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 11.04.15
 * Time: 9:29
 */


class Client extends Eloquent {

    protected $table = 'clients';




    public static function getClients(){
        $result = Cache::remember('getClients', Helper::cacheTime(), function () {
            return Client::all();
        });
        return $result;
    }


    public static function getName($id){
        $result = Client::find($id);
        if ($result){
            return $result->fio;
        }
        return "нет имени";
    }

    public static function getPhone($id){
        $result = Client::find($id);
        if ($result){
            return $result->phone;
        }
        return "нет телефона";
    }
}