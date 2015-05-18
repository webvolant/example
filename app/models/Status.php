<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 12.04.15
 * Time: 10:33
 */

class Status extends Eloquent{

    protected $table = 'status';


    public static function getName($id){
        $result = Status::find($id);
        if ($result){
            return $result->name;
        }
        return "нет статуса";
    }
}


