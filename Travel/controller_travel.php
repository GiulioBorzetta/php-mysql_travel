<?php

class TravelController
{
    public function filter()
    {
        include "./Travel/filter_travel.php";
    }

    public function manage()
    {
        include "./Travel/manage_travel.php";
    }

    public function get()
    {
        include "./Travel/insert_travel.php";
    }

    public function insert()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            include "./Travel/insert_travel.php";
        }
    }
}
