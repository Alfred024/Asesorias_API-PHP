<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        echo("OLA - DESDE - LA - API - DE - PHP");
    }
?>