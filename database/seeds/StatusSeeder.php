<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            //made to order
            [ 'title' => 'Submitted - Pending Quote' ], 
            [ 'title' => 'Quote Sent - Awaiting Response' ], 
            [ 'title' => 'Quote Rejected' ], 
            [ 'title' => 'Quote Accepted - Pending Payment' ], 
            [ 'title' => 'Quote Accepted - Payment Processing' ], 
            [ 'title' => 'Quote Accepted - Paid' ],
            [ 'title' => 'Item Under Construction' ],
            //buy it now
            [ 'title' => 'Order Initialized - Pending Payment' ],
            [ 'title' => 'Order Submitted - Paid' ],
            //universal
            [ 'title' => 'Preparing For Shipment' ],
            [ 'title' => 'Item Shipped' ],
            [ 'title' => 'Item Delivered' ],
            [ 'title' => 'Closed' ]
        ]);
    }
}
