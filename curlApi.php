<?php

function authenticate($data) {
    // prepare the request
    $clientId = $data["client_id"];
    $clientSecret = $data["client_secret"];
    $grantType = $data["grant_type"];

    $uri = getenv('BASE_URL')."/auth_token";
    $token = base64_encode("$clientId:$clientSecret");
    $payload = http_build_query([
        'grant_type' => $grantType,
    ]);

    // initialize the curl request
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $uri);
    curl_setopt( $ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded',
        "Authorization: Bearer $token"
    ]);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // process request and return the response
    $response = curl_exec($ch);
    $response = json_decode($response, true);
    if (! isset($response['access_token'])
        || ! isset($response['token_type'])) {
        return false;
    }

    return $response['access_token'];
}

function greatFoodLabAPI($method, $url, $access_token, $data = false)
{
    $curl = curl_init();

    switch ($method)
    {
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, $data);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    $headers = array(
        'Content-Type: application/json',
        'Authorization: Bearer '.$access_token
    );

    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    if(!$result){
        return false;
    }

    curl_close($curl);

    return $result;
}
