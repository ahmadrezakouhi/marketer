<?php


function createAllMarketerTree($root)
{
    $output = "<ul>";
    foreach ($root as $m) {
        $output .="<li>";
        $output .="".$m->user->name .' '.$m->user->last_name;

        $child=$m->marketers()->get();
        // $output .= "<ul>";
        // foreach ( $child as $m2) {

        //     $output .="<li>";
        //     $output .=$m2->user->name.' '.$m2->user->last_name;
        //     $output .="</li>";
        //     $output .="</ul>";
        // }
        // $output .="</li>";
        if(count($child)>0){
           $output .= createAllMarketerTree($child);
        }
    }
    $output .="</ul>";

    return $output;
}


function createSubMarketerTree($marketers)
{

    $output = "<ul>";
    foreach ($marketers as $m) {
        $output .="<li>";
        $output .="".$m->user->name;

        $child=$m->marketers()->get();
        $output .= "<ul>";
        foreach ( $child as $m2) {

            $output .="<li>";
            $output .=$m2->user->name.' '.$m2->user->last_name;
            $output .="</li>";
            $output .="</ul>";
        }
        $output .="</li>";
    }
    $output .="</ul>";

    return $output;
}




function calculateCommission($price,$commission)
{
    $result = ($price*$commission)/100;
    return $result;
}
