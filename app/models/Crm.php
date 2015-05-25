<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 02.04.15
 * Time: 17:15
 */


class Crm extends Eloquent {

    protected $softDelete = true;
    protected $table = 'crms';

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function klinika()
    {
        return $this->belongsTo('Klinika');
    }

}