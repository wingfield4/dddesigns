<?php

namespace App\Http\Controllers;

use Google\Cloud\Storage\StorageClient;

use App\Http\Controllers\Controller;
use App\CustomizationResponse;
use App\Image;
use App\Item;
use App\Order;
use App\OrderItem;
use App\Address;
use App\UserAddress;
use App\OrderAddress;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrdersController extends Controller
{
    /**
     * Go to Orders Screen
     *
     * @return View
     */
    public function __invoke()
    {
        $user = Auth::user();
        return view('orders', [
          'user' => $user
        ]);
    }

    public function view(Request $request, $orderNumber)
    {
        $user = Auth::user();
        $order = Order::where('number', $orderNumber)->first();

        if(is_null($order))
        {
            abort(404);
        }

        if($order->token == $request->token)
        {
            return view('fullOrder', [
                'order' => $order,
                'user' => $user
            ]);
        }

        return view('order', [
            'order' => $order,
            'user' => $user
        ]);
    }

    public function submit(Request $request)
    {
        $user = Auth::user();
        $item = Item::find($request->itemId);

        if(is_null($item))
        {
            abort(404);
        }

        //create address
        $address = new Address;
        $address->address_line_1 = $request->addressLine1;
        $address->address_line_2 = $request->addressLine2;
        $address->address_line_3 = $request->addressLine3;
        $address->address_line_4 = $request->addressLine4;
        $address->city = $request->city;
        $address->state = $request->state;
        $address->zip = $request->zip;
        $address->country = $request->country;
        $address->save();

        //create order
        $order = new Order;
        $order->number = uniqid();
        $order->status_id = $item->item_type_id == 1 ? Order::$PENDING_QUOTE : Order::$ORDER_INITIALIZED;
        if(!is_null($user)) $order->user_id = $user->id;
        $order->first_name = $request->firstName;
        $order->last_name = $request->lastName;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->address_id = $address->id;
        $order->save();

        //if user, create user address
        if(!is_null($user))
        {
            $userAddress = new UserAddress;
            $userAddress->user_id = $user->id;
            $userAddress->address_id = $address->id;
            $userAddress->save();
        }

        //create order item
        $orderItem = new OrderItem;
        $orderItem->order_id = $order->id;
        $orderItem->item_id = $item->id;
        $orderItem->save();

        foreach($item->customizations as $customization)
        {
            $customizationResponse = new CustomizationResponse;
            $customizationResponse->order_item_id = $orderItem->id;
            $customizationResponse->customization_id = $customization->id;

            //Text Response
            if($customization->customization_type_id == 1)
            {
                $value = $request['customization'.$customization->id];
                $customizationResponse->text_response = $value;
            }
            //Options
            else if($customization->customization_type_id == 2)
            {
                $value = $request['customization'.$customization->id];

                if($value == 'custom') {
                    $customizationResponse->custom_response = $request['customization'.$customization->id.'Custom'];
                }
                else
                {
                    $customizationResponse->option_id = $value;
                }
            }
            //Image upload
            else if($customization->customization_type_id == 3)
            {
                $path = $request->file('customization'.$customization->id)->store('private');
                $filename = basename($path);

                $storage = new StorageClient([
                    'projectId' => 'dddesigns'
                ]);
                $bucket = $storage->bucket('dddesigns-private');
                $bucket->upload(Storage::get($path), [
                    'name' => $filename
                ]);

                $image = new Image;
                $image->small_path = $filename;
                $image->medium_path = $filename;
                $image->full_path = $filename;
                $image->save();

                $customizationResponse->image_id = $image->id;
            }

            $customizationResponse->save();
        }

        if($order->status_id == Order::$PENDING_QUOTE)
        {
            $email = new \SendGrid\Mail\Mail();
            $email->setFrom('danielle.wendell@dddesigns.store', 'Danielle Wendell');
            $email->setSubject('Thank you for your order!');
            $email->addTo('d.wingfield815@gmail.com', 'David Wingfield');
            $email->addContent('text/plain', 'You order of '.$item->title.' has been placed.');
            $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
            $response = $sendgrid->send($email);
        }
        
        return redirect()->to('orders/'.$order->number.'?token='.$order->token);
    }

    public function submitPayment(Request $request)
    { 
        $user = Auth::user();
        $order = Order::find($request->orderId);

        if($request->token != $order->token && (is_null($user) || $order->user_id != $user->id))
        {
            abort(404);
        }

        $order->status_id = 9;
        $order->save();

        return redirect()->to('/orders/'.$order->number);
    }
}