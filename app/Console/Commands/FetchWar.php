<?php

namespace App\Console\Commands;

use App\Events\NewWarStarted;
use App\Models\War;
use App\Services\FoxholeWarApi\DTO\WarDTO;
use App\Services\FoxholeWarApi\FoxholeWarApiInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FetchWar extends Command
{
    private FoxholeWarApiInterface $warApi;

    public function __construct(FoxholeWarApiInterface $warApi)
    {
        $this->warApi = $warApi;

        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-war';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $warInfo = $this->warApi->getWarInfo();
        /** @var War $war */
        $war = War::where('war_id', $warInfo->getWarId())->first();

        if ($war === null) {
            DB::transaction(static function () use ($warInfo) {
                War::active()->update(['is_active' => false]);
                War::create($warInfo->toArray());
            });
            return;
        }
        DB::transaction(static function () use ($war, $warInfo) {
            if (!$war->is_active) {
                War::active()->update(['is_active' => false]);
                $war->is_active = true;
            }
            if ($war->winner !== $warInfo->getWinner()) {
                $war->winner = $warInfo->getWinner();
                $war->conquest_end_time = $warInfo->getConquestEndTime();
                $war->resistance_start_time = $warInfo->getResistanceStartTime();
            }

            $war->required_victory_towns = $warInfo->getRequiredVictoryTowns();
            $war->update();
        });
    }
}
