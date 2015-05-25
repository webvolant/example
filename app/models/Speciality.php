<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 01.04.15
 * Time: 13:31
 */


class Speciality extends Eloquent {

    protected $softDelete = true;
    protected $table = 'specialities';

    public function Users()
    {
        return $this->belongsToMany('User', 'user_specialities', 'speciality_id', 'user_id');
    }

    public function Articles()
    {
        return $this->hasMany('Article');
    }

    public function getSpecialities()
    {
        return 1;
    }

}