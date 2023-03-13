<?php

namespace App\Services\FoxholeWarApi;

use App\Services\FoxholeWarApi\DTO\WarDTO;

interface FoxholeWarApiInterface
{
    public function getWarInfo(): WarDTO;
}
