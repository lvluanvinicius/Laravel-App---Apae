<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\GeneralSettingsException;
use App\Http\Controllers\Controller;
use App\Models\Settings;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GeneralSettingsController extends Controller
{
    /**
     * Guarda o modelo de Settings.
     *
     * @var Settings
     */
    protected Settings $settings;

    /**
     * Construtor de inicialização.
     */
    public function __construct()
    {
        $this->settings = new Settings();
    }

    /**
     * Retornas configurações para edição.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     * @return View|RedirectResponse
     */
    public function index(): View|RedirectResponse
    {
        try {
            $settings = Settings::get();

            $newSettings = [];

            foreach ($settings as $stg) {
                if ($stg->setting_type === 'extensions') {
                    array_push($newSettings, [
                        "setting_name" => $stg->setting_name,
                        "setting_value" => join(",", unserialize($stg->setting_value)),
                        "setting_type" => $stg->setting_type,
                    ]);
                } else {
                    array_push($newSettings, [
                        "setting_name" => $stg->setting_name,
                        "setting_value" => $stg->setting_value,
                        "setting_type" => $stg->setting_type,
                    ]);
                }
            }

            return view('pages.admin.settings.general')->with([
                'title' => 'Configurações Geral',
                'settings' => $newSettings,
            ]);
        } catch (GeneralSettingsException $error) {
            return redirect()->back()->with([
                'status' => false,
                'message' => $error->getMessage(),
                'type' => 'Error',
            ])->withInput();
        } catch (Exception $error) {
            return redirect()->back()->with([
                'status' => false,
                'message' => $error->getMessage(),
                'type' => 'Error',
            ])->withInput();
        }
    }

    public function updateExtensions(Request $request)
    {
        try {
            // Recuperando dados.
            $requestData = $request->all();

            // Remove as keys desnecessárias.
            unset($requestData['_token']);
            unset($requestData['_method']);

            // Percorrendo e salvando os valores atualizados.
            foreach ($requestData as $key => $value) {
                $exts = serialize(explode(',', $value));
                $this->settings->updateSettings($key, ["setting_value" => $exts]);
            }

            return redirect()->route('admin.settings.general.index')->with([
                'status'        => true,
                'message'       => "Extensões atualizadas com sucesso.",
                'type'          => 'Success',
            ]);
        } catch (GeneralSettingsException $error) {
            return redirect()->back()->with([
                'status' => false,
                'message' => $error->getMessage(),
                'type' => 'Error',
            ])->withInput();
        } catch (Exception $error) {
            return redirect()->back()->with([
                'status' => false,
                'message' => $error->getMessage(),
                'type' => 'Error',
            ])->withInput();
        }
    }

    public function updatePaths(Request $request)
    {
        try {
            // Recuperando dados.
            $requestData = $request->all();

            // Remove as keys desnecessárias.
            unset($requestData['_token']);
            unset($requestData['_method']);

            // Percorrendo e salvando os valores atualizados.
            foreach ($requestData as $key => $value) {
                $this->settings->updateSettings($key, ["setting_value" => $value]);
            }

            return redirect()->route('admin.settings.general.index')->with([
                'status'        => true,
                'message'       => "Diretórios atualizados com sucesso.",
                'type'          => 'Success',
            ]);
        } catch (GeneralSettingsException $error) {
            return redirect()->back()->with([
                'status' => false,
                'message' => $error->getMessage(),
                'type' => 'Error',
            ])->withInput();
        } catch (Exception $error) {
            return redirect()->back()->with([
                'status' => false,
                'message' => $error->getMessage(),
                'type' => 'Error',
            ])->withInput();
        }
    }
}