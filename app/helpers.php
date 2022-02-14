<?php


function createAllMarketerTree($root)
{
    $output = "<ul>";
    foreach ($root as $m) {
        $output .= "<li>";
        $output .= "" . $m->user->name . ' ' . $m->user->last_name;

        $child = $m->marketers()->get();
        // $output .= "<ul>";
        // foreach ( $child as $m2) {

        //     $output .="<li>";
        //     $output .=$m2->user->name.' '.$m2->user->last_name;
        //     $output .="</li>";
        //     $output .="</ul>";
        // }
        // $output .="</li>";
        if (count($child) > 0) {
            $output .= createAllMarketerTree($child);
        }
    }
    $output .= "</ul>";

    return $output;
}


function createSubMarketerTree($marketers)
{

    $output = "<ul>";
    foreach ($marketers as $m) {
        $output .= "<li>";
        $output .= "" . $m->user->name;

        $child = $m->marketers()->get();
        $output .= "<ul>";
        foreach ($child as $m2) {

            $output .= "<li>";
            $output .= $m2->user->name . ' ' . $m2->user->last_name;
            $output .= "</li>";
            $output .= "</ul>";
        }
        $output .= "</li>";
    }
    $output .= "</ul>";

    return $output;
}




function calculateCommission($price, $commission)
{
    $result = ($price * $commission) / 100;
    return $result;
}



function send_sms($receptor, $template, $type, $token, $token2, $token3,$token10,$token20)
{
    try {
        // $receptor =  "09130774939";
        // $template =  "verifycode";
        // $type =  "sms";
        // $token =  "تست";
        // $token2 =  "";
        // $token3 =  "";
        $result =  Kavenegar::VerifyLookup($receptor, $token, $token2, $token3, $template, $type,$token10,$token20);
        if ($result) {
            return response()->json(['error' => $result], 500);
        }
    } catch (\Kavenegar\Exceptions\ApiException $e) {
        // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
        echo $e->errorMessage();
    } catch (\Kavenegar\Exceptions\HttpException $e) {
        // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
        echo $e->errorMessage();
    }
}
