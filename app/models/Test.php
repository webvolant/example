<?php
use Baum\Node;


/**
* Category
*/
class Test extends Node {

  /**
   * Table name.
   *
   * @var string
   */
    protected $table = 'tests';
    protected $orderColumn = 'lft';

  //////////////////////////////////////////////////////////////////////////////

    public function Kliniks()
    {
        return $this->belongsToMany('Klinika', 'klinika_tests', 'test_id', 'klinik_id')->withPivot('price');
        //return $this->belongsToMany('Profession', 'doctor_professions', 'doctor_id', 'profession_id')->withPivot('doctor_got_professions');
    }

    //для поиска
    public static function getTreeWithLinks(){
        $tests = Test::where('name','!=','root')->orderBy('lft')->get();
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

    //Для детальной записи диаг.центра
    public static function getListWithPrice($kl){
        $tests = $kl->Tests()->withPivot('price')->orderBy('lft')->get();
        $cap = "";
        foreach($tests as $test){
            //var_dump($test->id);
            $price = $test->pivot->price;
            if ($test->parent()->first()->name != 'root')
                $parent_link = $test->parent()->first()->link;

            if ($test->getLevel()==1){
                $cap .= "<p class=''><span class='top h4_my margin5'>".$test->name.'<span></p>';
            }elseif ($test->getLevel()==2) {
                $cap .= "<p><div class='pull-left'><a id='$test->id' class='h6_my margin-left10 diag_link' href='"."/diagnostica/centers/$parent_link/$test->link'>".$test->name.'</a></div>'."<div class='h4_my_bold pull-right'>$price сом</div>".'<div><hr class="with_border"/></div></p>';
            }elseif ($test->getLevel()==3) {
                $cap .= "<p><div class='pull-left'><a id='$test->id' class='h6_my margin-left20 diag_link' href='"."/diagnostica/centers/$parent_link/$test->link'>".$test->name.'</a></div>'."<div class='h4_my_bold pull-right'>$price сом</div>".'<div><hr class="with_border"/></div></p>';
            }
        }

        return $cap;
    }



  //
  // Below come the default values for Baum's own Nested Set implementation
  // column names.
  //
  // You may uncomment and modify the following fields at your own will, provided
  // they match *exactly* those provided in the migration.
  //
  // If you don't plan on modifying any of these you can safely remove them.
  //

  // /**
  //  * Column name which stores reference to parent's node.
  //  *
  //  * @var string
  //  */
  // protected $parentColumn = 'parent_id';

  // /**
  //  * Column name for the left index.
  //  *
  //  * @var string
  //  */
  // protected $leftColumn = 'lft';

  // /**
  //  * Column name for the right index.
  //  *
  //  * @var string
  //  */
  // protected $rightColumn = 'rgt';

  // /**
  //  * Column name for the depth field.
  //  *
  //  * @var string
  //  */
  // protected $depthColumn = 'depth';

  // /**
  //  * Column to perform the default sorting
  //  *
  //  * @var string
  //  */
  // protected $orderColumn = null;

  // /**
  // * With Baum, all NestedSet-related fields are guarded from mass-assignment
  // * by default.
  // *
  // * @var array
  // */
  // protected $guarded = array('id', 'parent_id', 'lft', 'rgt', 'depth');

  //
  // This is to support "scoping" which may allow to have multiple nested
  // set trees in the same database table.
  //
  // You should provide here the column names which should restrict Nested
  // Set queries. f.ex: company_id, etc.
  //

  // /**
  //  * Columns which restrict what we consider our Nested Set list
  //  *
  //  * @var array
  //  */
  // protected $scoped = array();

  //////////////////////////////////////////////////////////////////////////////

  //
  // Baum makes available two model events to application developers:
  //
  // 1. `moving`: fired *before* the a node movement operation is performed.
  //
  // 2. `moved`: fired *after* a node movement operation has been performed.
  //
  // In the same way as Eloquent's model events, returning false from the
  // `moving` event handler will halt the operation.
  //
  // Below is a sample `boot` method just for convenience, as an example of how
  // one should hook into those events. This is the *recommended* way to hook
  // into model events, as stated in the documentation. Please refer to the
  // Laravel documentation for details.
  //
  // If you don't plan on using model events in your program you can safely
  // remove all the commented code below.
  //

  // /**
  //  * The "booting" method of the model.
  //  *
  //  * @return void
  //  */
  // protected static function boot() {
  //   // Do not forget this!
  //   parent::boot();

  //   static::moving(function($node) {
  //     // YOUR CODE HERE
  //   });

  //   static::moved(function($node) {
  //     // YOUR CODE HERE
  //   });
  // }

}
