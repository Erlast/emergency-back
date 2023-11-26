<?php

namespace App\Events;


class SaveCartridgeHistory
{

    private $cartridgeId;
    private $statusFrom;
    private $statusTo;
    private $department_id;

    public function __construct($cartridge, $statusFrom)
    {
        $this->cartridgeId = $cartridge->id;
        $this->statusTo = $cartridge->status;
        $this->department_id = $cartridge->department_id;
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

    public function getDepartmentId()
    {
        return $this->department_id;
    }
}
