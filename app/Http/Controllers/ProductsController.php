<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Item;
use App\Review;

class ProductsController extends Controller
{
    /**
     * Go to Login Screen
     *
     * @return View
     */
    public function __invoke()
    {
        $user = Auth::user();
        $items = Item::where('deleted_at', null)
            ->where('public', true)
            ->get();

        return view('products', [
          'items' => $items,
          'user' => $user,
          'baseImagePath' => $this->BASE_IMAGE_PATH
        ]);
    }

    public function authorizeCustomization($itemPageUrl)
    {
        if(Auth::check())
        {
            return redirect()->to('products/'.$itemPageUrl.'/customize');
        }

        return view('authorizeCustomization', [
            'itemPageUrl' => $itemPageUrl
        ]);
    }

    public function authorizeCustomizationSubmit($itemPageUrl, Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->to('products/'.$itemPageUrl.'/customize');
        }

        return view('authorizeCustomization', [
            'email' => $request->email,
            'error' => 'Sorry, those credentials don\'t match',
            'itemPageUrl' => $itemPageUrl
        ]);
    }

    public function customize($itemPageUrl, Request $request)
    {
        $user = Auth::user();
        $item = Item::where('item_page_url', $itemPageUrl)->first();

        if(!$item) abort(404);

        if($user == null && (!$request->has('guest') || $request->guest != 'true')) {
            return redirect()->to('products/'.$itemPageUrl.'/authorize');
        }

        return view('customize', [
            'item' => $item,
            'user' => $user,
            'baseImagePath' => $this->BASE_IMAGE_PATH,
            'user' => $user
        ]);
    }

    public function product($itemPageUrl)
    {
        $user = Auth::user();
        $item = Item::where('item_page_url', $itemPageUrl)->first();
        if(!$item || !$item->public || !is_null($item->deleted_at)) abort(404);

        $reviews = Review::where('item_id', $item->id)->get();

        return view('product', [
            'item' => $item,
            'reviews' => $reviews,
            'user' => $user,
            'baseImagePath' => $this->BASE_IMAGE_PATH
        ]);
    }
}