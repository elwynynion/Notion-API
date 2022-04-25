<?php

define('SECRET_KEY', 'YOUR SECRET KEY');
    
// process the submmitted form
if (isset($_POST['name']) && isset($_POST['email'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];

    echo $name . ' ' . $email;
    
    $target_db_id = "11be67441cea4d69ad92395e50156e2e";

$post_data = [
    "parent" => ["database_id" => $target_db_id],
    "properties" => [
        "Name" => [
            "title" => [
                [
                    "text" => [
                        "content" => $name,
                    ],
                ],
            ],
        ],

        'Email' => [
            'email' => $email,
        ],

        "Date Added" => [
            "date" => [
                "start" => date('Y-m-d'),
            ],
        ],

        
    ],
];


$header = ['Authorization: Bearer ' . SECRET_KEY, 'Content-Type: application/json', 'Notion-Version: 2022-02-22'];

$url = 'https://api.notion.com/v1/pages';

$curl = curl_init($url);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
//POST
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($post_data));

$result = curl_exec($curl);

echo $result;

$jsonDecode = json_decode($result, true);
// echo $jsonDecode['url'];
    
header('Location: /?success=1&url=' . $jsonDecode['url']);
}