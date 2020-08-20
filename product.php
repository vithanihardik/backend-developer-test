<?php

function getProduct($product_id, $base_url, $access_token, $template){
    $productResponse = greatFoodLabAPI("GET",$base_url."/menu/".$product_id."/products", $access_token);

    if(!$productResponse){
        die("Something went wrong!");
    }

    $productResponse = json_decode($productResponse);

    foreach($productResponse->data as $key=>$value){
        $template .= "<tr><td>" . $value->id . "</td><td>" . ucfirst($value->name) . "</td></tr>";
    }

    $template .= "</tbody></table></body></html>";

    echo $template;
}

function updateProduct($menu_id, $product_id,  $base_url, $access_token){

    $data = json_decode(file_get_contents("php://input"), true);

    $productResponse = greatFoodLabAPI("PUT",$base_url."/menu/".$menu_id."/product/".$product_id, $access_token, $data);

    if(!$productResponse){
        die("Something went wrong!");
    }

    echo $productResponse;
}

?>