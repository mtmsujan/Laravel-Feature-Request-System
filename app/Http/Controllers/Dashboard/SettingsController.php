<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $h = $setting->colors->primary->h;
        $s = $setting->colors->primary->s;
        $l = $setting->colors->primary->l;
        $primary = hsl2hex($h, $s, $l);
        $secondary = $setting->colors->secondary ?? null;
        $h = $secondary->h ?? 0;
        $s = $secondary->s ?? 0;
        $l = $secondary->l ?? 0;
        $secondary = hsl2hex($h, $s, $l);
        $colors = getAppColors();

        return view('dashboard.settings.index', compact('setting', 'colors'));
    }

    public function update(Request $request)
    {
        $colors = [];
        if ($request->colors) {
            foreach ($request->colors as $i => $color) {
                $colors[$i] = hex2hsl($color);
            }
        }
        Setting::updateOrCreate(['id' => 1], [
            'app_name' => $request->app_name,
            'favicon' => $request->has('favicon') ? saveFile($request->favicon, 'settings', 'favicon') : app('favicon'),
            'logo' => $request->has('logo') ? saveFile($request->logo, 'settings', 'logo') : app('logo'),
            'colors' => $colors,
        ]);
        notify()->success('Settings Updated!');

        return back();
    }
}
