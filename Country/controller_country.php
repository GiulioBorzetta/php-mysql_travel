<?php

class CountryController
{
    public function manage()
    {
        include "./Country/manage_country.php";
    }

    public function get()
    {
        include "./Country/insert_country.php";
    }

    public function insert()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            include "./Country/insert_country.php";
        }
    }
}
