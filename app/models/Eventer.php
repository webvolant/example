<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 11.04.15
 * Time: 10:15
 */

class Eventer extends Eloquent{

    protected $softDelete = true;
    protected $table = 'events';


    public function status()
    {
        return $this->belongsTo('Status');
    }

}