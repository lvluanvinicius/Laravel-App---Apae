<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\AppResponse;

class StatuteController extends Controller
{
    use AppResponse;

    /**
     * Retorna o dislay de estatuto.
     *
     * @author Luan VP Santos <lvluansantos@gmail.com>
     *
     * @return \Illuminate\View\View
     */
    public function index(): \Illuminate\View\View
    {
        // Recuperando registro do estatuto.
        $statute = (new \App\Models\Statute())->where('status', true)->first();

        return view('pages.admin.statute.index')->with([
            'title' => 'Estatuto',
            'statute' => $statute,
        ]);
    }

    /**
     * Cria um estatuto e apaga o anterior.
     *
     * @author Luan VP Santos <lvluansantos@gmail.com>
     *
     * @param \App\Http\Requests\StatuteCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(\App\Http\Requests\StatuteCreateRequest $request): \Illuminate\Http\RedirectResponse
    {
        try {
            // Valida se o arquivo foi informado.
            if (!$request->hasFile('file')) {
                throw new \Exception('Arquivo inválido ou não informado.');
            }

            // Valida se o arquivo é válido.
            if (!$request->file('file')->isValid()) {
                throw new \Exception('Arquivo enviado é inválido.');
            }

            // Recuperando dados da requisição.
            $file = $request->file('file');

            $fileName = $file->getClientOriginalName();

            // Recuperando path de destino.
            $path = storage_path('app/public/statute');

            // Iniciando modelo de estatuto.
            $statute = new \App\Models\Statute();

            // Validando há um registro ativo de estatuto para ser excluído.
            if ($statuteDelete = $statute->where('status', true)->first()) {
                // Valida se o arquivo existe e o apaga.
                if (file_exists($path . "/" . $statuteDelete->file_name)) {
                    unlink($path . "/" . $statuteDelete->file_name);
                }

                // Excluindo registro.
                $statuteDelete->delete();
            }

            // Dados para salvar registro.
            $fileRegister = [
                "file_name" => $fileName,
                "status" => true,
                "name" => $fileName,
            ];

            // Criando registro do estatuto.
            if (!$statute->create($fileRegister)) {
                throw new \Exception("Erro ao registrar os dados do arquivo.");
            }

            // Enviando o arquivo para o diretório.
            if (!$file->move($path, $fileName)) {
                throw new \Exception("Erro ao salvar o arquivo.");
            }

            return $this->redirectSuccess("Estatuto criado com sucesso.");
        } catch (\Exception $error) {
            return $this->redirectError($error->getMessage(), \Illuminate\Http\Response::HTTP_BAD_REQUEST);
        }
    }
}
