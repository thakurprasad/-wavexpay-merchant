<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use DB;

class GeneralSettingController extends Controller
{
    public function index(Request $request){
        $general_settings = DB::table('general_settings')->get();
        return view('pages.settings.index', compact('general_settings'));
    }

    public function getGeneralSetting(Request $request)
    {
        $id = $request->id;
        $general_settings = DB::table('general_settings')->where('id',$id)->first();
        return view('pages.settings.edit', compact('general_settings'));
    }

    public function updateGeneralSetting(Request $request, $id)
    {
        $this->validate($request, [
            'theme_color' => 'required|max:200',
        ]);
        $input = $request->all();
        unset($input['_token']);
        if ($files = $request->file('logo')) {
            // Define upload path
            $destinationPath = public_path('/images/logo/'); // upload path
            // Upload Orginal Image
            $uploadedImage = 'logo_'.date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $uploadedImage);
            $input['logo'] = $uploadedImage;
        }
        DB::table('general_settings')->where('id',$id)->update($input);
        return redirect()->route('general-settings')
                        ->with('success','Updated successfully');
    }

}
