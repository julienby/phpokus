<?php

namespace App\Controllers;

use GuzzleHttp\Client;

class ApiController {

    public function fetchData() {
        $client = new Client([
            'base_uri' => 'https://jsonplaceholder.typicode.com/',
            'timeout'  => 2.0,
        ]);

        $response = $client->request('GET', 'posts/1');

        // Vérifiez le statut de la réponse
        if ($response->getStatusCode() == 200) {
            // Récupérez le corps de la réponse
            $body = $response->getBody();
            $data = json_decode($body, true);

            // Utilisez les données récupérées
            print_r($data);
        } else {
            echo "Erreur : " . $response->getStatusCode();
        }
    }

    public function fetchDataWithCurl() {
        $url = "https://jsonplaceholder.typicode.com/posts/1";

        $ch = curl_init();

        // Configuration des options cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        // Exécute la requête cURL
        $response = curl_exec($ch);

        // Vérifie les erreurs
        if (curl_errno($ch)) {
            echo 'Erreur cURL : ' . curl_error($ch);
        } else {
            // Décoder la réponse
            $data = json_decode($response, true);
            print_r($data);
        }

        // Fermer la session cURL
        curl_close($ch);
    }
}

