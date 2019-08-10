<?php

namespace App\services;

interface IBD {

    public function find(string $sql);
    public function findAll(string $sql);
    public function getCount();

}