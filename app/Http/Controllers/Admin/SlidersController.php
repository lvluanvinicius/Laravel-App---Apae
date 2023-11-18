<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\SlidersExceptions;
use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Models\Sliders;
use Exception;
use Illuminate\Http\Request;

class SlidersController extends Controller
{
    public function index()
    {
        $sliders = Sliders::get();

        return view('pages.admin.sliders.index')->with([
            'title'         => 'Sliders',
            'sliders'       => $sliders,
        ]);
    }

    public function create() 
    {
        return view('pages.admin.sliders.create')->with([
            'title'         => 'Novo Slider',
        ]);
    }

    public function store(Request $request)
    {
        try {
            // Verificando se o arquivo foi informado.
            if (!$request->hasFile('slider_image')) {
                throw new SlidersExceptions('Informe uma imagem.');
            }

            // Validando se a imagem é válida.
            if (!$request->file('slider_image')->isValid()) {
                throw new SlidersExceptions('Informe uma imagem válida.');
            }

            $file                   = $request->file('slider_image'); # Recupera o arquivo.
            $ext                    = $file->getClientOriginalExtension(); # Recupera a extensão da imagem.
            $fileName               = explode('.', $file->getClientOriginalName())[0]; # Recupera a extensão da imagem.
            $fileSize               = $file->getSize(); # Recupera o tamanho do arquivo.
            $fileType               = $file->getType(); # Recupera o tipo do arquivo.

            // Recuperando extensões aceitas.
            $settings               = Settings::where('setting_name', 'application_sliders_extensions')->first('setting_value');

            // Transformando as extensões.
            $extensions             = unserialize($settings->setting_value);

            // Verificando extensões.
            $validateExtensions     = array_filter($extensions, function ($extV) use ($ext) {
                if ($extV == $ext) return true;
                return false;
            });

            // Validando extensão.
            if (!$validateExtensions) {
                throw new SlidersExceptions("Verifique a extensão da imagem, são aceito apenas '" . join('|', $extensions) . "'");;
            }

            // Gerando hash para o arquivo. 
            $fileHashString         = "";
            $f                      = true;
            while ($f) {
                $s                  = $fileName . '-' . md5($fileName . rand(100, 100000));
                $partFile           = Sliders::where('sliders_hash', $s)->first();
                if (!$partFile) {
                    $f              = false;
                    $fileHashString     = $s;
                }
            }

            dd($fileHashString);

            return serialize(['png','jpg', 'jpeg']);
        } catch(SlidersExceptions $error) {
            dd($error);
        } catch(Exception $error) {
            dd($error);
        }
    }
}
