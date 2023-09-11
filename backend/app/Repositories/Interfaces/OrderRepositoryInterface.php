<?php

namespace App\Repositories\Interfaces;

interface OrderRepositoryInterface
{
    public function getList(array $params);
    public function store(array $params);

    public function confirm(array $params);

    public function updateProcess(array $params);
}
