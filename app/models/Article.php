<?php

class Article extends Eloquent {

    protected $softDelete = true;
	protected $table = 'articles';

    /****** СВЯЗИ *//////////////////

   /* public function speciality()
    {
        return $this->hasOne('Speciality');
    }*/


}
