<?php

include "curlApi.php";

function getMenu($base_url, $access_token, $template){

    $menuResponse = greatFoodLabAPI("GET",$base_url."/menus", $access_token);

    if(!$menuResponse){
        die("Something went wrong!");
    }

    $menuResponse = json_decode($menuResponse);

    foreach($menuResponse->data as $key=>$value){
        $template .= "<tr><td>" . $value->id . "</td><td>" . ucfirst($value->name ) . "</td></tr>";
    }

    $template .= "</tbody></table></body></html>";

    echo $template;
}

?>
