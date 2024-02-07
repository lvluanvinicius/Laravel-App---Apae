<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\SlidersExceptions;
use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Models\Sliders;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SlidersController extends Controller
{
    use ApiResponse;

    /**
     * Lista todos os sliders.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     * @return View
     */
    public function index(): View
    {
        $sliders = Sliders::get();

        return view('pages.admin.sliders.index')->with([
            'title'         => 'Sliders',
            'sliders'       => $sliders,
        ]);
    }

    /**
     * Exibe display de cadastro de novos sliders.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     * @return View
     */
    public function create(): View
    {
        return view('pages.admin.sliders.create')->with([
            'title'         => 'Novo Slider',
        ]);
    }

    /**
     * Salva um novo slider.
     *
     * @param Request $request
     * 
     * @author Luan Santos <lvluansantos@gmail.com>
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            // Verificando se o arquivo foi informado.
            if (!$request->hasFile('file')) {
                throw new SlidersExceptions('Informe uma imagem.');
            }

            // Validando se a imagem é válida.
            if (!$request->file('file')->isValid()) {
                throw new SlidersExceptions('Informe uma imagem válida.');
            }

            $file                   = $request->file('file'); # Recupera o arquivo.
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

            // Inserinfo Slider na base. 
            $slider = Sliders::create([
                'sliders_hash'              => $fileHashString,
                'sliders_size'              => $fileSize,
                'sliders_image'             => $fileHashString . "." . $ext,
                'sliders_format'            => $fileType,
            ]);

            // Verificando se o parceiro foi criado. 
            if ($slider) {
                // Recuperando path das imagens de parceiros.
                $imagePath          = Settings::where('setting_name', 'application_sliders_path')->first('setting_value');

                // Efetuando upload da imagem.
                $file->move($imagePath->setting_value, "{$fileHashString}.{$ext}");

                return $this->success('Slider criado com sucesso.');
            }

            throw new SlidersExceptions('Não foi possível salvar o slider.');
        } catch (SlidersExceptions $error) {
            return $this->errorWithCode($error->getMessage(), 200, $error->getCode());
        } catch (Exception $error) {
            return $this->error($error->getMessage());
        }
    }

    /**
     * Ativa ou desative um slider.
     *
     * @param string $sliderId
     * 
     * @author Luan Santos <lvluansantos@gmail.com>
     * @return RedirectResponse
     */
    public function activeAndSlider(string $sliderId): RedirectResponse
    {
        try {
            // Criando modelo de slider. 
            $slider = new Sliders();

            // Ativando o slider.
            if ($slider->activeAndDeactive($sliderId)) {
                return redirect()->route('admin.sliders.index')->with([
                    'status'        => true,
                    'message'       => 'Slider ativado com sucesso.',
                    'type'          => 'Success',
                ]);
            }

            return redirect()->route('admin.sliders.index')->with([
                'status'        => true,
                'message'       => 'Slider desativado com sucesso.',
                'type'          => 'Success',
            ]);
        } catch (SlidersExceptions $error) {
            return redirect()->back()->with([
                'status'        => false,
                'message'       => $error->getMessage(),
                'type'          => 'Error',
            ])->withInput();
        } catch (Exception $error) {
            return redirect()->back()->with([
                'status'        => false,
                'message'       => $error->getMessage(),
                'type'          => 'Error',
            ])->withInput();
        }
    }

    /**
     * Efetua a exclusão do slider.
     *
     * @param string $sliderId
     * 
     * @author Luan Santos <lvluansantos@gmail.com>
     * @return RedirectResponse
     */
    public function destroy(string $sliderId): RedirectResponse
    {
        try {
            // Recupera o slider a ser excluído. 
            $slider = Sliders::where('id', $sliderId)->first();

            // Verificando se existe o slider. 
            if (!$slider) {
                throw new SlidersExceptions('Slider não encontrado para exclusão.');
            }

            if ($slider->delete()) {
                // Recuperando path das imagens de parceiros.
                $imagePath          = Settings::where('setting_name', 'application_sliders_path')->first('setting_value');

                // Verifica se a imagem existe.
                if (file_exists("{$imagePath->setting_value}/{$slider->sliders_image}")) {
                    unlink("{$imagePath->setting_value}/{$slider->sliders_image}");
                }

                return redirect()->route('admin.sliders.index')->with([
                    'status'        => true,
                    'message'       => "Parceiro excluído com sucesso.",
                    'type'          => 'Success',
                ]);
            }

            throw new SlidersExceptions('Não foi possível excluír o slider.');
        } catch (SlidersExceptions $error) {
            return redirect()->back()->with([
                'status'        => false,
                'message'       => $error->getMessage(),
                'type'          => 'Error',
            ])->withInput();
        } catch (Exception $error) {
            return redirect()->back()->with([
                'status'        => false,
                'message'       => $error->getMessage(),
                'type'          => 'Error',
            ])->withInput();
        }
    }
}