<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 11.04.15
 * Time: 9:29
 */


class Order extends Eloquent {

    use SoftDeletingTrait;

    protected $table = 'orders';

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function client()
    {
        return $this->belongsTo('Client');
    }

    public function otziv()
    {
        return $this->belongsTo('Otziv');
    }
/*
    public function Events()
    {
        return $this->belongsToMany('Event', 'order_events','order_id', 'event_id');//->withPivot('');
        //return $this->belongsToMany('Profession', 'doctor_professions', 'doctor_id', 'profession_id')->withPivot('doctor_got_professions');
    }
*/
    public function events()
    {
        return $this->hasMany('Eventer');
    }


}