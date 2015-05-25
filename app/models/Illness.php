<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 22.04.15
 * Time: 8:31
 */


class Illness extends Eloquent {

    protected $softDelete = true;
    protected $table = 'problems';

    /****** СВЯЗИ *//////////////////

    /* public function speciality()
     {
         return $this->hasOne('Speciality');
     }*/


    //для поиска
    /*
    public static function getTreeWithLinks(){
        $tests = Illness::all();
        $cap = "";

        foreach($tests as $test){
            $parent_link = $test->parent()->first()->link;
            //if ($test->parent()->first()->name != 'root')
            //    $parent_link = $test->parent()->first()->link;

            if ($test->getLevel()==1){
                $cap .= "<p id='$test->id'><a class='h6_my' href='"."/diagnostica/centers/$test->link"."'>".$test->name.'</a></p>';
            }elseif ($test->getLevel()==2) {
                $cap .= "<p id='$test->id'><a class='h6_my margin-left10' href='"."/diagnostica/centers/$parent_link/$test->link"."'>".$test->name.'</a></p>';
            }elseif ($test->getLevel()==3) {
                $cap .= "<p id='$test->id'><a class='h6_my margin-left20' href='"."/diagnostica/centers/$parent_link/$test->link"."'>".$test->name.'</a></p>';
            }
        }

        return $cap;
    }
*/

}