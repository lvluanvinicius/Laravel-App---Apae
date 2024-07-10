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
    public function index(): View | RedirectResponse
    {
        try {
            if (auth()->user()->rule !== 'admin') {
                return redirect()->route('admin.index');
            }

            // Recupeta todas as configurações.
            $settings = Settings::get();

            $newSettings = []; // Auxiliar de configurações.

            foreach ($settings as $stg) {
                if ($stg->setting_type === 'extensions') {
                    array_push($newSettings, [
                        "setting_name" => $stg->setting_name,
                        "setting_value" => join(",", unserialize($stg->setting_value)),
                        "setting_type" => $stg->setting_type,
                    ]);
                } else if ($stg->setting_type === 'mail') {
                    array_push($newSettings, [
                        "setting_name" => $stg->setting_name,
                        "setting_value" => unserialize($stg->setting_value),
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

    /**
     * Atualiza as extensões;
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateExtensions(Request $request): RedirectResponse
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
                'status' => true,
                'message' => "Extensões atualizadas com sucesso.",
                'type' => 'Success',
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

    /**
     * Atualiza os paths.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function updatePaths(Request $request): RedirectResponse
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
                'status' => true,
                'message' => "Diretórios atualizados com sucesso.",
                'type' => 'Success',
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

    /**
     * Atualiza as configurações do servidor.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateMailServer(Request $request): RedirectResponse
    {
        try {
            // Recuperando dados.
            $requestData = $request->only([
                "MAIL_HOST",
                "MAIL_PORT",
                "MAIL_USERNAME",
                "MAIL_PASSWORD",
                "MAIL_ENCRYPTION",
                "MAIL_EHLO_DOMAIN",
                "MAIL_TIMEOUT",
                "URL",
                "TRANSPORT",
                "MAIL_MAILER",
                "email",
                "subject",
            ]);

            // Populando configurações e salvando em bando.
            \App\Repositories\SettingsRepository::updateMailServer(
                'application_complaints_mail',
                serialize([
                    "email" => $requestData['email'],
                    "subject" => $requestData['subject'],
                    "mail_settings" => [
                        "MAIL_HOST" => $requestData['MAIL_HOST'],
                        "MAIL_PORT" => $requestData['MAIL_PORT'],
                        "MAIL_USERNAME" => $requestData['MAIL_USERNAME'],
                        "MAIL_PASSWORD" => $requestData['MAIL_PASSWORD'],
                        "MAIL_ENCRYPTION" => $requestData['MAIL_ENCRYPTION'],
                        "MAIL_EHLO_DOMAIN" => $requestData['MAIL_EHLO_DOMAIN'],
                        "MAIL_TIMEOUT" => $requestData['MAIL_TIMEOUT'],
                        "URL" => $requestData['URL'],
                        "TRANSPORT" => $requestData['TRANSPORT'],
                        "MAIL_MAILER" => $requestData['MAIL_MAILER'],
                    ],
                ])

            );

            return redirect()->route('admin.settings.general.index')->with([
                'status' => true,
                'message' => "Servidor atualizado com sucesso.",
                'type' => 'Success',
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