<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function set(Request $request)
    {
        $a = $request->address;

        $addresses = session()->get('addresses');
        $selected_address = $addresses[$a];
        
        // return view('order.create')->with('selected_address', $selected_address);
        return redirect()->back()->with('selected_address', $selected_address);
    }

    public function delete($id)
    {
        $addresses = session()->get('addresses');
        if (isset($addresses[$id])) {
            unset($addresses[$id]);
            session()->put('addresses', $addresses);
        }
        return redirect()->back();
    }
}
