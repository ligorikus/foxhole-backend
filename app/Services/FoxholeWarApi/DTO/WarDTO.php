<?php

namespace App\Services\FoxholeWarApi\DTO;

use Carbon\Carbon;
use DateTime;

class WarDTO
{
    protected string $warId;
    protected int $warNumber;
    protected int $winner;
    protected DateTime $conquestStartTime;
    protected DateTime $conquestEndTime;
    protected DateTime $resistanceStartTime;
    protected int $requiredVictoryTowns;

    /**
     * @return string
     */
    public function getWarId(): string
    {
        return $this->warId;
    }

    /**
     * @param  string  $warId
     */
    public function setWarId(string $warId): void
    {
        $this->warId = $warId;
    }

    /**
     * @return int
     */
    public function getWarNumber(): int
    {
        return $this->warNumber;
    }

    /**
     * @param  int  $warNumber
     */
    public function setWarNumber(int $warNumber): void
    {
        $this->warNumber = $warNumber;
    }

    /**
     * @return int
     */
    public function getWinner(): int
    {
        return $this->winner;
    }

    /**
     * @param  int  $winner
     */
    public function setWinner(int $winner): void
    {
        $this->winner = $winner;
    }

    public function setWinnerByString(string $winner): void
    {
        $this->winner = match ($winner) {
            'COLONIALS' => 1,
            'WARDENS' => 2,
            default => 0
        };
    }

    /**
     * @return DateTime
     */
    public function getConquestStartTime(): DateTime
    {
        return $this->conquestStartTime;
    }

    /**
     * @param  int  $conquestStartTime
     */
    public function setConquestStartTime(int $conquestStartTime): void
    {
        $this->conquestStartTime = Carbon::createFromTimestampMs($conquestStartTime);
    }

    /**
     * @return DateTime|null
     */
    public function getConquestEndTime(): DateTime|null
    {
        return $this->conquestEndTime ?? null;
    }

    /**
     * @param  int  $conquestEndTime
     */
    public function setConquestEndTime(int $conquestEndTime): void
    {
        $this->conquestEndTime = Carbon::createFromTimestampMs($conquestEndTime);
    }

    /**
     * @return DateTime|null
     */
    public function getResistanceStartTime(): DateTime|null
    {
        return $this->resistanceStartTime ?? null;
    }

    /**
     * @param  int  $resistanceStartTime
     */
    public function setResistanceStartTime(int $resistanceStartTime): void
    {
        $this->resistanceStartTime = Carbon::createFromTimestampMs($resistanceStartTime);
    }

    /**
     * @return int
     */
    public function getRequiredVictoryTowns(): int
    {
        return $this->requiredVictoryTowns;
    }

    /**
     * @param  int  $requiredVictoryTowns
     */
    public function setRequiredVictoryTowns(int $requiredVictoryTowns): void
    {
        $this->requiredVictoryTowns = $requiredVictoryTowns;
    }

    public function toArray(): array
    {
        return [
            'war_id' => $this->warId,
            'war_number' => $this->warNumber,
            'winner' => $this->winner,
            'conquest_start_time' => $this->conquestStartTime,
            'conquest_end_time' => $this->conquestEndTime ?? null,
            'resistance_start_time' => $this->resistanceStartTime ?? null,
            'required_victory_towns' => $this->requiredVictoryTowns ?? null,
        ];
    }
}
