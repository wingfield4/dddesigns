<?php

namespace App\Http\Controllers;

use Google\Cloud\Storage\StorageClient;

use App\Http\Controllers\Controller;
use App\CustomizationType;
use App\Item;
use App\Order;
use App\Image;
use App\ItemImage;
use App\ItemType;
use App\ItemInformation;
use App\Customization;
use App\Option;
use App\Status;
use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    /**
     * Go to Welcome Screen
     *
     * @return View
     */
    public function __invoke()
    {
        $user = Auth::user();

        $items = Item::where('deleted_at', null)->get();

        $activeOrderCount = Order::where('deleted_at', null)
            ->whereIn('status_id', Order::$activeStatusIds)
            ->count();
        $closedOrderCount = Order::where('deleted_at', null)
            ->whereIn('status_id', Order::$closedStatusIds)
            ->count();

        $userCount = User::where('deleted_at', null)
            ->count();

        return view('admin', [
            'activeOrderCount' => $activeOrderCount,
            'closedOrderCount' => $closedOrderCount,
            'items' => $items,
            'userCount' => $userCount,
            'user' => $user
        ]);
    }

    public function addItemCustomization($itemId)
    {
        $user = Auth::user();
        $item = Item::find($itemId);

        $customizationTypes = CustomizationType::where('deleted_at', null)->get();

        return view('addItemCustomization', [
            'customizationTypes' => $customizationTypes,
            'item' => $item,
            'user' => $user
        ]);
    }

    public function addItemImages($itemId)
    {
        $user = Auth::user();
        $item = Item::find($itemId);

        return view('addItemImages', [
            'item' => $item,
            'user' => $user
        ]);
    }

    public function addItemInformation($itemId)
    {
        $user = Auth::user();
        $item = Item::find($itemId);

        return view('addItemInformation', [
            'item' => $item,
            'user' => $user
        ]);
    }

    public function addItem()
    {
        $user = Auth::user();
        $itemTypes = ItemType::where('deleted_at', null)->get();

        return view('addItem', [
            'itemTypes' => $itemTypes,
            'user' => $user
        ]);
    }

    public function editItem($itemId)
    {
        $user = Auth::user();
        $item = Item::find($itemId);
        $itemTypes = ItemType::where('deleted_at', null)->get();

        return view('editItem', [
            'item' => $item,
            'itemTypes' => $itemTypes,
            'user' => $user
        ]);
    }

    public function editItemCustomization($customizationId)
    {
        $user = Auth::user();

        $customization = Customization::find($customizationId);
        $item = Item::find($customization->item_id);

        $customizationTypes = CustomizationType::where('deleted_at', null)->get();

        return view('addItemCustomization', [
            'customization' => $customization,
            'customizationTypes' => $customizationTypes,
            'item' => $item,
            'user' => $user
        ]);
    }

    public function editItemInformation($informationId)
    {
        $user = Auth::user();

        $information = ItemInformation::find($informationId);
        $item = Item::find($information->item_id);

        return view('addItemInformation', [
            'information' => $information,
            'item' => $item,
            'user' => $user
        ]);
    }

    public function file($fileName)
    {
        // $storage = new StorageClient([
        //     'projectId' => 'dddesigns'
        // ]);
        // $bucket = $storage->bucket('dddesigns-private');
        // $object = $bucket->object($fileName);
        // $url = $object->signedUrl(
        //     # This URL is valid for 15 minutes
        //     new \DateTime('15 min'),
        //     [
        //         'version' => 'v4'
        //     ]
        // );
        return redirect()->away('https://storage.cloud.google.com/dddesigns-private/'.$fileName);
    }

    public function item($itemId)
    {
        $user = Auth::user();

        $item = Item::find($itemId);

        return view('adminItem', [
            'item' => $item,
            'user' => $user
        ]);
    }

    public function items()
    {
        $user = Auth::user();

        $items = Item::where('deleted_at', null)->get();

        return view('adminItems', [
            'items' => $items,
            'user' => $user
        ]);
    }

    public function order($orderNumber)
    {
        $user = Auth::user();
        $order = Order::where('number', $orderNumber)->first();
        $statuses = Status::where('deleted_at', null)->get();

        if(is_null($order))
        {
            abort(404);
        }

        return view('adminOrder', [
            'order' => $order,
            'statuses' => $statuses,
            'user' => $user
        ]);
    }

    public function orders(Request $request)
    {
        $user = Auth::user();

        $orderQuery = Order::where('deleted_at', null);

        if($request->status == 'active')
            $orderQuery = $orderQuery->whereIn('status_id', Order::$activeStatusIds);
        else if($request->status == 'closed')
            $orderQuery = $orderQuery->whereIn('status_id', Order::$closedStatusIds);
        else if($request->status == 'inactive')
            $orderQuery = $orderQuery->whereIn('status_id', Order::$inactiveStatusIds);

        $orderQuery = $orderQuery->orderBy($request->orderBy ?? 'created_at', $request->orderDirection ?? 'desc');

        $orders = $orderQuery->get();

        return view('adminOrders', [
            'orders' => $orders,
            'status' => $request->status,
            'user' => $user
        ]);
    }

    public function users(Request $request)
    {
        $user = Auth::user();

        $usersCount = User::where('deleted_at', null)->count();

        $page = $request->page ?? 1;
        $pageSize = $request->pageSize ?? 20;

        $users = User::where('deleted_at', null)
            ->orderBy('created_at', 'desc')
            ->take($pageSize)
            ->skip(($page-1)*$pageSize)
            ->get();

        return view('adminUsers', [
            'page' => $page,
            'pageSize' => $pageSize,
            'users' => $users,
            'usersCount' => $usersCount,
            'user' => $user
        ]);
    }

    public function submitItemImage(Request $request)
    {
        $path = $request->file('file')->store('public');
        $filename = basename($path);

        $storage = new StorageClient([
            'projectId' => 'dddesigns'
        ]);
        $bucket = $storage->bucket('dddesigns');
        $bucket->upload(Storage::get($path), [
            'name' => $filename
        ]);

        $image = new Image;
        $image->small_path = $filename;
        $image->medium_path = $filename;
        $image->full_path = $filename;
        $image->save();

        $itemImageCount = ItemImage::where('item_id', $request->itemId)
            ->where('deleted_at', null)
            ->count();

        if($itemImageCount == 0)
        {
            $item = Item::find($request->itemId);
            $item->thumbnail_image_id = $image->id;
            $item->save();
        }

        $itemImage = new ItemImage;
        $itemImage->item_id = $request->itemId;
        $itemImage->image_id = $image->id;
        $itemImage->order = $itemImageCount + 1;
        $itemImage->save();
    }

    public function submitItem(Request $request)
    {
        $user = Auth::user();
        
        $item = new Item;
        $item->title = $request->title;
        $item->short_description = $request->shortDescription;
        $item->long_description = $request->longDescription;
        $item->price = $request->price;
        $item->item_page_url = $request->url;
        $item->item_type_id = $request->itemTypeId;
        $item->public = false;
        $item->save();

        return redirect()->to('/admin/item/'.$item->id);
    }

    public function submitEditItem(Request $request)
    {
        $user = Auth::user();
        
        $item = Item::find($request->itemId);
        $item->title = $request->title;
        $item->short_description = $request->shortDescription;
        $item->long_description = $request->longDescription;
        $item->price = $request->price;
        $item->item_type_id = $request->itemTypeId;
        // $item->item_page_url = $request->url;
        $item->save();

        return redirect()->to('/admin/item/'.$item->id);
    }

    public function submitCustomization(Request $request)
    {
        $customization = new Customization;

        $customization->item_id = $request->itemId;
        $customization->title = $request->title;
        $customization->description = $request->description;
        $customization->required = $request->required == 'on' ? true : false;
        $customization->customization_type_id = $request->customizationType;
        $customization->save();

        if($customization->customization_type_id == 1) //free text
        {
            $customization->free_text_min_length = $request->minLength;
            $customization->free_text_max_length = $request->maxLength;
        }
        else if($customization->customization_type_id == 2) //options
        {
            $customization->allow_custom_option = $request->allowCustomOption == 'on' ? true : false;
            $customization->custom_option_description = $request->customOptionDescription;

            //add options

            for($i = 1; $i < 50; $i++)
            {
                $title = $request['option'.$i.'Title'];
                $description = $request['option'.$i.'Description'];
                $price = $request['option'.$i.'Price'];

                if($title != null && $title != '')
                {
                    $option = new Option;
                    $option->title = $title;
                    $option->description = $description;
                    $option->price = $price;
                    $option->customization_id = $customization->id;
                    $option->save();
                }
            }
        }
        else if($customization->customization_type_id == 2) //image
        {
            //nothing for now
        }

        $customization->save();

        return redirect()->to('/admin/item/'.$request->itemId);
    }

    public function submitEditCustomization(Request $request)
    {
        $customization = Customization::find($request->customizationId);

        $customization->title = $request->title;
        $customization->description = $request->description;
        $customization->required = $request->required == 'on' ? true : false;
        $customization->customization_type_id = $request->customizationType;
        $customization->save();

        if($customization->customization_type_id == 1) //free text
        {
            $customization->free_text_min_length = $request->minLength;
            $customization->free_text_max_length = $request->maxLength;
        }
        else if($customization->customization_type_id == 2) //options
        {
            //delete all old options
            Option::where('customization_id', $customization->id)->delete();

            $customization->allow_custom_option = $request->allowCustomOption == 'on' ? true : false;
            $customization->custom_option_description = $request->customOptionDescription;

            //and recreate new ones
            for($i = 1; $i < 50; $i++)
            {
                $title = $request['option'.$i.'Title'];
                $description = $request['option'.$i.'Description'];
                $price = $request['option'.$i.'Price'];

                if($title != null && $title != '')
                {
                    $option = new Option;
                    $option->title = $title;
                    $option->description = $description;
                    $option->price = $price;
                    $option->customization_id = $customization->id;
                    $option->save();
                }
            }
        }
        else if($customization->customization_type_id == 2) //image
        {
            //nothing for now
        }

        $customization->save();

        return redirect()->to('/admin/item/'.$request->itemId);
    }

    public function submitInformation(Request $request)
    {
        $information = new ItemInformation;

        $information->title = $request->title;
        $information->description = $request->description;
        $information->item_id = $request->itemId;
        $information->save();

        return redirect()->to('/admin/item/'.$request->itemId);
    }

    public function submitEditInformation(Request $request)
    {
        $information = ItemInformation::find($request->informationId);

        $information->title = $request->title;
        $information->description = $request->description;
        $information->save();

        return redirect()->to('/admin/item/'.$request->itemId);
    }

    public function privatizeItem($itemId)
    {
        $item = Item::find($itemId);
        $item->public = false;
        $item->save();

        return redirect()->to('/admin/item/'.$item->id);
    }

    public function publicizeItem($itemId)
    {
        $item = Item::find($itemId);
        $item->public = true;
        $item->save();

        return redirect()->to('/admin/item/'.$item->id);
    }

    public function deleteCustomization($customizationId)
    {
        $customization = Customization::find($customizationId);
        $customization->delete();

        return redirect()->to('/admin/item/'.$customization->item_id);
    }

    public function deleteImage($imageId, $itemId)
    {
        $image = Image::find($imageId);
        $image->delete();

        return redirect()->to('/admin/item/'.$itemId);
    }

    public function deleteInformation($informationId)
    {
        $information = ItemInformation::find($informationId);
        $information->delete();

        return redirect()->to('/admin/item/'.$information->item_id);
    }

    public function applyOrderFilters(Request $request)
    {
        $status = $request->status;

        return redirect()->to('/admin/orders?status='.$status);
    }
}