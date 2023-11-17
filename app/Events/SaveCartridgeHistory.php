<?php

namespace App\Events;


use App\Models\Cartstorage;

class SaveCartridgeHistory
{

    private $cartridgeId;
    private $statusFrom;
    private $statusTo;

    public function __construct($cartridge, $statusFrom)
    {
        $this->cartridgeId = $cartridge->id;
        $this->statusTo = $cartridge->disloc;
        $this->statusFrom = $statusFrom;
    }

    public function getCartridgeId()
    {
        return $this->cartridgeId;
    }

    public function getStatusFrom()
    {
        return $this->statusFrom;
    }

    public function getStatusTo()
    {
        return $this->statusTo;
    }
}
