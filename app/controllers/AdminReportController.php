<?php
/**
 * Created by PhpStorm.
 * User: barkalovlab
 * Date: 15.05.15
 * Time: 1:17
 */

class AdminReportController extends Controller {

    public function wait()
    {
        $seconds = date('U', time());

        $orders = array();
        //$events = array();// date( "U" );//date( "d.m.Y H:i" );
        $eventers = Eventer::where('flag','!=',3)->where('date_end','!=','')->take(Helper::getEventsCount())->get();
        foreach ($eventers as $i):
            $object = DateTime::createFromFormat('d.m.Y H:i', $i->date_end);
            $object_seconds = $object->format('U');
            $last_time = (($object_seconds - $seconds)/60);
            if (($last_time <= Helper::orderTime()) && ($last_time > Helper::latestOrderTime())){
                //$orders =
                /*$link ="<li class='divider'></li><li><a href = /admin/order/edit/$i->order_id >
                             <div>
                                <i class='fa fa-envelope fa-fw'></i> Заявка N$i->order_id
                                    <span class='pull-right text-muted small'>$last_time - осталось времени.</span>
                            </div>
                          </a></li>";*/
                array_push($orders,$i->order_id);
            }
        endforeach;
        return View::make('admin.report.orders',array('orders'=>$orders));
    }


}