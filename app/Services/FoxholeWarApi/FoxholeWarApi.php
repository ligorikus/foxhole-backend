<?php

namespace App\Services\FoxholeWarApi;

use App\Services\FoxholeWarApi\DTO\WarDTO;
use Illuminate\Support\Facades\Http;

class FoxholeWarApi implements FoxholeWarApiInterface
{
    public const WAR_API_URI = "https://war-service-live.foxholeservices.com/api/worldconquest/";

    public const WAR = 'war';

    public function getWarInfo(): WarDTO
    {
        $warInfo = Http::get(self::WAR_API_URI.self::WAR)->json();

        $war = new WarDTO();
        $war->setWarId($warInfo['warId']);
        $war->setWarNumber($warInfo['warNumber']);
        $war->setWinnerByString($warInfo['winner']);
        $war->setConquestStartTime($warInfo['conquestStartTime']);
        if ($warInfo['conquestEndTime'] !== null) {
            $war->setConquestEndTime($warInfo['conquestEndTime']);
        }
        if ($warInfo['resistanceStartTime'] !== null) {
            $war->setResistanceStartTime($warInfo['resistanceStartTime']);
        }
        $war->setRequiredVictoryTowns($warInfo['requiredVictoryTowns']);
        return $war;
    }
}
