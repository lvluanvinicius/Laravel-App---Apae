<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\SettingsException;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function iThemes() 
    {
        try {

            if (auth()->user()->ui_theme == 'light') {
                $user = User::where('id', auth()->user()->id)->update([
                    'ui_theme'  => 'dark',
                ]);

                return redirect()->back();
            }

            if (auth()->user()->ui_theme == 'dark') {
                $user = User::where('id', auth()->user()->id)->update([
                    'ui_theme'  => 'light',
                ]);

                return redirect()->back();
            }
            
        } catch (SettingsException $error) {
            return redirect()->back()->with([
                "message"   => $error->getMessage(),
                "type"      => 'error',
                'status'    => false,
            ]);
        }
    }
}
