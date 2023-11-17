<?php

namespace App\Listeners;

use App\Events\SaveCartridgeHistory;
use App\Models\CartridgeHistory;

class HistorySubscriber
{

    public function saveHistory(SaveCartridgeHistory $cartridgeHistory)
    {
        CartridgeHistory::create([
            'cartridge_id' => $cartridgeHistory->getCartridgeId(),
            'status_from' => $cartridgeHistory->getStatusFrom(),
            'status_to' => $cartridgeHistory->getStatusTo()
        ]);
    }

    public function subscribe($events)
    {
        $events->listen(
            SaveCartridgeHistory::class,
            'App\Listeners\HistorySubscriber@saveHistory'
        );
    }
}
