<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 05.05.15
 * Time: 11:33
 */



Route::group(array('prefix' => 'admin', 'before' => 'operator'), function()
{

    Route::get('test/index', array('as' => 'test/index',
        'uses' => 'AdminTestController@index'));

    //Route::post('category/show', array('as' => 'category',
    //    'uses' => 'CategoryController@show'));


    Route::get('test/add', array('as' => 'test/add',
        'uses' => 'AdminTestController@add'));

    Route::post('test/add', function () {

        $rules = array(
            //'name_ru' => array('required')
            //'parent_id' => array('required')
        );

        $validation = Validator::make(Input::all(), $rules);

        if ($validation->fails()) {
            // проверка не пройдена.
            return Redirect::to('category::add')->withInput()->withErrors($validation);
        }

        if ($validation->passes()) {
            // проверка не пройдена.
            $parent_id = Input::get('parent_id');
            if ($parent_id){
                $root = Test::find($parent_id);

                $cat = $root->children()->create(['name' => Input::get('name')]);
                //$cat->name = Input::get('name');
                $cat->save();
                //$name_ru = Input::get('name_ru');
                //$cat = $root->children()->create(['name_ru' => $name]);
            }else{
                $node = new Test();
                $node->parent_id = null;
                $node->name = Input::get('name');
                $node->save();

            }

            //$cat->save();
            return Redirect::route('test/index')->withInput();
        }

    });



    Route::post('test/edit/{id}',
        function($id) {
            $rules = array(
                //'name_ru' => array('required')
                //'parent_id' => array('required')
            );

            $validation = Validator::make(Input::all(), $rules);

            if ($validation->passes()) {
                // проверка не пройдена.
                $parent_id = Input::get('parent_id');
                $node = Test::find($id);
                foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties):
                    $name_lang = "name_$localeCode";
                    $node->$name_lang = Input::get($name_lang);
                endforeach;
                $node->parent_id = $parent_id;
                $node->save();
                return Redirect::route('test/index')->withInput();
            }else{
                return Redirect::route('test/edit')->withInput()->withErrors($validation);
            }
        });

    Route::get('test/edit/{link}', array(
        'as' => 'test/edit',
        'uses' => 'AdminTestController@edit'
    ))->where('id', '[A-Za-z-_]+');


    Route::get('test/delete/{id}', array(
        'as' => 'test/delete',
        'uses' => 'AdminTestController@delete'
    ))
        ->where('id', '[0-9]+');

});