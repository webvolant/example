<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 25.01.15
 * Time: 4:29
 */



use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;



class AdminTestController extends Controller {

    public function all(){
        $nodes = \Test::orderBy('lft')->get();
        return View::make('admin.test.list', array('nodes'=>$nodes));
    }

    public function index(){
        //$root = Category::find(10);

        //CategoryController::recurs($root);

        //$child1 = $root->children()->create(['name' => 'Product 1.1.1']);
        //$child2 = $root->children()->create(['name' => 'Product 1.1.2']);

        /*foreach ($root->getImmediateDescendants() as $item){
            echo '<pre>';
            echo $item->name;
            echo '</pre>';
        }*/

        //$nestedList = Category::getNestedList('name');

        $node = \Test::where('name', '=', 'root')->first();
        //if ($node->count()==0)
        //$root = Test::create(['name' => 'root']);
        /*$nestedList = Category::getNestedList('name');
        foreach ($nestedList as $item){
            echo '<pre>';
                $item;
            echo '</pre>';
        }
        echo '<pre>';
            print_r($nestedList);
        echo '</pre>';*/
        return View::make('admin.test.list', array('node'=>$node));
    }

    /**********add******/
    public function add(){
        $parentList = \Test::getNestedList('name');
        return View::make('admin.test.add', array('list'=>$parentList));
    }

    /**********edit******/
    public function edit($id){
        $cat = \Test::find($id);
        $name = "name";
        $parentList = \Test::getNestedList($name);
        return View::make('admin.test.edit', array('list'=>$parentList))->with('cat', $cat);
    }

    /**********delete******/
    public function delete($link){
        $cat = \Test::find($link);
        $cat->delete();
        //$parentList = \Category::getNestedList('name_ru');
        return Redirect::route('test/index');
    }


        public static function recurs($node){
                        foreach($node->getImmediateDescendants() as $descendant) {
                            //echo $descendant->$name;
                            echo "<tr>
                                <td>".$descendant->id."</td>
                                <td>".$descendant->name."</td>
                                <td>$descendant->parent_id</td>
                                <td>$descendant->created_at</td>
                                <td>"."<a href=". URL::route('test/edit', array($descendant->id)) ."  class='btn btn-info'>". 'edit' ."</a>"
                                     ."<a href=". URL::route('test/delete', array($descendant->id)) ."  class='btn btn-danger'>". 'delete' ."</a>"
                                ."</td>
                            </tr>";
                            if ($descendant->getImmediateDescendants())
                            {
                                AdminTestController::recurs($descendant);
                            }
                        }
        }

}