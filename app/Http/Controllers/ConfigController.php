<?php

namespace App\Http\Controllers;

use App\Config;
use Illuminate\Http\Request;

use App\Http\Requests;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.configs')->with([
            'configs' => Config::all()
        ]);
    }


    public function store(Request $request)
    {
        //
        $config = new Config();
        $config->config = $request->config;
        $config->value = $request->value;
        $config->description = $request->description;
        $config->save();
    }
    public function update(Request $request, Config $config)
    {
        //
        $config->value = $request->value;

        $config->update();
        return back();
    }


    public function destroy(Config $config)
    {
        //
        Config::destroy($config->id);
        return back();
    }
}
