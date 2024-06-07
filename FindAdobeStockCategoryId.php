<?php

$apiKey = 'ApiKey';
$xproduct = 'ProductCode';
function FindCategory($id = null)
{
    global $apiKey, $xproduct;

// Set the URL for the Adobe Stock API endpoint
    $url = 'https://stock.adobe.io/Rest/Media/1/Search/CategoryTree';

// Set the query parameters
    if ($id) {
        $params = [
            'x-api-key' => $apiKey,
            'X-product' => $xproduct,
            'category_id' => $id,
        ];
    } else {
        $params = [
            'x-api-key' => $apiKey,
            'X-product' => $xproduct,
        ];
    }

// Build the cURL request
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'x-api-key: ' . $apiKey,
        'x-product: ' . $xproduct,
    ]);

// Execute the cURL request
    $response = curl_exec($ch);

// Check for errors
    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
    } else {
        // Process the response
        $data = json_decode($response, true);
        // Do something with the data

    }

    return $data;
}


foreach (FindCategory() as $category1) {
    echo '-'.$category1['id'] . ' |' . $category1['name'] . PHP_EOL;


    foreach (FindCategory($category1['id']) as $category) {
        echo '--'.$category['id'] . ' |' . $category['name'] . PHP_EOL;

    }
}
?>