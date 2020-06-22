<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Order;

class StoreOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $Order ;
    /*
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    */
     public function __construct()
    {
        
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // stroe on order object
       // echo "order saved and name is: " .$this->order->name ." and maghsad is :" .
        //$this->order->maghsad;
        for($i=0;$i<5000;$i++)
        {
            $order = new Order();
            $order->name ="name".$i;
            $order->maghsad = "maghsad".$i;
            $order->save();
        }
    }
}
