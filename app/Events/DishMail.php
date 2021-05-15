<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DishMail
{
    use SerializesModels;
    public $dishId;
    
    public function __construct($dishId)
    {
        $this->dishId = $dishId;
    }
    public function broadcastOn()
    {
        return [];
    }
}
