<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\TransparencyException;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransparencyRequest;
use App\Models\Settings;
use App\Models\Transparency;
use App\Models\TransparencyFolders;
use App\Models\TransparencyYear;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;

class TransparencyController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     * @return View
     */
    public function index(): View
    {
        $years              = TransparencyYear::orderBy('year_folder', 'desc')->get();

        $dataTransparency   = [];

        // Recuperando valores das pastas pais de anos.
        foreach ($years as $y) {
            // Recuperando as pastas.
            $folders = TransparencyFolders::where('cod_transparency_year_fk', $y->id)->get(['id', 'cod_transparency_year_fk', 'folders', 'hash']);

            $newFolders = [];

            foreach ($folders as $fd) {
                $files = Transparency::where('cod_transparency_folders_fk', $fd->id)->get(['id', 'filename', 'hash', 'cod_transparency_folders_fk']);
                array_push($newFolders, [
                    'id'                => $fd->id,
                    'folders'           => $fd->folders,
                    'hash'              => $fd->hash,
                    'files'             => $files,
                ]);
            }

            $nData = [
                'id'                => $y->id,
                'year_folder'       => $y->year_folder,
                'folders'           => $newFolders,
            ];

            array_push($dataTransparency, $nData);
        }

        // return $dataTransparency;

        return view('pages.admin.transparency.index')->with([
            'title'             => "Portal da Transparência",
            'transparency'      => $dataTransparency,
        ]);
    }

    /**
     * Efetua a inserção de um novo ano dentro da transparência.
     *
     * @param TransparencyRequest $request
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     * @return RedirectResponse
     */
    public function createFolderYear(TransparencyRequest $request): RedirectResponse
    {
        try {
            // Recuperando name do request.
            $foldName = $request->year_folder;

            // Verifica se o ano possui 4 dígitos numéricos
            if (preg_match('/^\d{4}$/', $foldName)) {
                // Verifica se o ano é um ano válido de acordo com a função checkdate()
                if (checkdate(1, 1, (int)$foldName)) {
                    // Instanciando modelo.
                    $yearTransparency = TransparencyYear::create([
                        "year_folder"   => $foldName,
                    ]);

                    // Validando a criação da pasta.
                    if ($yearTransparency) {
                        return redirect()->back()->with([
                            'status'        => true,
                            'message'       => "Ano inserido com sucesso na transparência.",
                            'type'          => 'Success',
                        ]);
                    }
                }
            } else {
                throw new TransparencyException('');
            }

            throw new TransparencyException('Houve um erro ao tentar inserir um novo ano dentro da transparência.');
        } catch (TransparencyException $error) {
            return redirect()->back()->with([
                'status'        => false,
                'message'       => $error->getMessage(),
                'type'          => 'Error',
            ]);
        } catch (Exception $error) {
            return redirect()->back()->with([
                'status'        => false,
                'message'       => $error->getMessage(),
                'type'          => 'Error',
            ]);
        }
    }

    /**
     * Retorna o display de criação de pasta de sessão.
     *
     * @param string $folderYearId
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     * @return View
     */
    public function createFolderSession(string $folderYearId): View
    {
        $year                   = TransparencyYear::where('id', $folderYearId)->first();
        return view('pages.admin.transparency.addsession')->with([
            'title'             => "Nova Sessão",
            'year'              => $year,
        ]);
    }


    /**
     * Cria uma nova sessão dentro de uma pasta do tipo ano.
     *
     * @param Request $request
     * @param string $folderYearId
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     * @return RedirectResponse
     */
    public function createFolderSessionStore(Request $request, string $folderYearId): RedirectResponse
    {
        try {
            // Recuperando nome da sessão que será criada.
            $foldName       = $request->folder_session;

            // Recuperando pasta ano (pasta pai).
            $foldYear       = TransparencyYear::where('id', $folderYearId)->first();

            // Verificando se a pasta ano existe.
            if (!$foldYear) {
                throw new TransparencyException('Não encontrada o ano correspondente.');
            }

            // Gaurda a hash que ira usar na pasta.
            $hashString     = "";

            // Gerando uma has para o arquivo.
            $validate = true;
            while ($validate) {
                // Gerando Hash.
                $s = md5($foldName . rand(100, 100000000));

                // Checa se existe a hash gerada, se não existir irá parar o loop e salvar em banco.
                if (!TransparencyFolders::where('hash', $s)->first()) {
                    $hashString = $s;
                    $validate = false;
                }
            }

            // Salvando nova sessão no banco.
            $newSessFolder = TransparencyFolders::create([
                'folders'                       => $foldName,
                'hash'                          => $hashString,
                'cod_transparency_year_fk'      => $foldYear->id,
            ]);

            // Verifica se foi criado corretanente a sessão.
            if ($newSessFolder) {
                return redirect()->route('admin.transparency.index')->with([
                    'status'        => true,
                    'message'       => "Sessão criada com sucesso.",
                    'type'          => 'Success',
                ]);
            }

            throw new TransparencyException('Houve um erro ao tentar criar a nova sessão.');
        } catch (TransparencyException $error) {
            return redirect()->back()->with([
                'status'        => false,
                'message'       => $error->getMessage(),
                'type'          => 'Error',
            ]);
        } catch (Exception $error) {
            return redirect()->back()->with([
                'status'        => false,
                'message'       => $error->getMessage(),
                'type'          => 'Error',
            ]);
        }
    }

    /**
     * Exibe o display de upload de arquivos.
     *
     * @param string $folderSession
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     * @return View|RedirectResponse
     */
    public function createFileSession(string $folderSession): View|RedirectResponse
    {
        try {
            // Recuperando pasta para receber o arquivo.
            $folder                 = TransparencyFolders::where('id', $folderSession)->first();

            // Verifica se a pasta existe.
            if (!$folder) {
                throw new TransparencyException('Não encontrada a pasta para inserir documento.', 1200);
            }


            return view('pages.admin.transparency.addfile')->with([
                'title'             => "Novo arquivo",
                'folder'            => $folder,
            ]);
        } catch (TransparencyException $error) {
            return redirect()->back()->with([
                'status'        => false,
                'message'       => $error->getMessage(),
                'type'          => 'Error',
            ]);
        } catch (Exception $error) {
            return redirect()->back()->with([
                'status'        => false,
                'message'       => $error->getMessage(),
                'type'          => 'Error',
            ]);
        }
    }

    /**
     * Recupera todos os arquivos de uma pasta.
     *
     * @param string $folderSession
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     * @return JsonResponse
     */
    public function getFilesSession(string $folderSession): JsonResponse
    {
        try {
            // Recuperando pasta.
            $folder             = TransparencyFolders::where('id', $folderSession)->first();

            // Verifica se a pasta existe.
            if (!$folder) {
                throw new TransparencyException('Não encontrada a pasta para inserir documento.', 1200);
            }

            // Recuperando arquivos.
            $files              = Transparency::where('cod_transparency_folders_fk', $folderSession)->get();

            // Verifica se os arquivos foram encontrados.
            if (!$files) {
                throw new TransparencyException('Nenhum arquivo encontrado para a pasta informada.', 1106);
            }

            return $this->success('Arquivos recuperados.', $files->toArray());
        } catch (TransparencyException $error) {
            return $this->errorWithCode($error->getMessage(), 200, $error->getCode());
        } catch (Exception $error) {
            return $this->error($error->getMessage());
        }
    }

    /**
     * Salva um novo arquivo dentro da base e storage.
     *
     * @param Request $request
     * @param string $folderSession
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     * @return JsonResponse
     */
    public function createFileSessionStore(Request $request, string $folderSession): JsonResponse
    {
        try {
            // Recuperando pasta para receber o arquivo.
            $folder                 = TransparencyFolders::where('id', $folderSession)->first();

            // Verifica se a pasta existe.
            if (!$folder) {
                throw new TransparencyException('Não encontrada a pasta para inserir documento.', 1200);
            }

            // Verificando se foi encaminhado um arquivo.
            if (!$request->hasFile('file')) {
                throw new TransparencyException('Informe um documento.', 1100);
            }

            // Validando se é um arquivo.
            if (!$request->file('file')->isValid()) {
                throw new TransparencyException('Informe um documento válido.', 1101);
            }

            // Recuperando arquivo.
            $file               = $request->file('file');
            $ext                = $file->getClientOriginalExtension();
            $fileName           = $file->getClientOriginalName();
            $fileSize           = $file->getSize();
            $typeFile           = $file->getType();

            // Validando extensão.
            $setting = Settings::where('setting_name', 'application_transparency_extensions')->first('setting_value');
            // Recupera as extensões.
            $extensions = unserialize($setting->setting_value);

            // Valida a extensão do arquivo.
            $validateExts = array_filter($extensions, function ($valExt) use ($ext) {
                if ($valExt == $ext) {
                    return true;
                }
                return false;
            });

            // Verificando status da validação das extensões.
            if (!$validateExts) {
                throw new TransparencyException("Verifique a extensão do documento, são aceito apenas '" . join('|', $extensions) . "'");
            }

            // Recuperando storage path
            $storagePath = storage_path('transparency');

            // Verificando se o arquivo já existe.
            $checkFile = Transparency::where('filename', $fileName)->first();
            if ($checkFile) {
                // Verifica se existe no path.
                if (file_exists($storagePath . '/' . $fileName . '.' . $ext)) {
                    throw new TransparencyException('O documento já existe e no diretório de armazenamento.', 1102);
                }
                // Se não existir, informa o erro que está registrado na base de dados apenas.
                throw new TransparencyException('O documento já está registrado na base.', 1103);
            }

            // Salvando arquivo no diretório.
            $path = $file->storeAs('public/transparency', $fileName);
            // Verifica se o arquivo fora salvo com sucesso.
            if (!$path) {
                throw new TransparencyException('Erro ao tentar salvar o documento ou diretório é inexistente.', 1104);
            }

            /**
             * Salvando dados do arquivo em base.
             */
            $hashString     = "";               # Gaurda a hash que ira usar na pasta.

            // Gerando uma has para o arquivo.
            $validate = true;
            while ($validate) {
                // Gerando Hash.
                $s = md5($fileName . rand(100, 100000000));

                // Checa se existe a hash gerada, se não existir irá parar o loop e salvar em banco.
                if (!Transparency::where('hash', $s)->first()) {
                    $hashString = $s;
                    $validate = false;
                }
            }

            // Inserindo na base.
            $fileSave = Transparency::create([
                'cod_transparency_folders_fk'           => $folder->id,
                'filename'                              => $fileName,
                'hash'                                  => $hashString,
                'type_file'                             => $typeFile,
                'size_file'                             => $fileSize,
                'ext'                                   => $ext
            ]);

            // Verifica se o arquivo foi salvo corretamente.
            if (!$fileSave) {
                // Exclui o arquivo no diretório se não for salvo em base.
                Storage::deleteIfExists($storagePath . '/' . $fileName . '.' . $ext);

                throw new TransparencyException('Não foi possível salvar o documento na base de dados.', 1105);
            }

            return $this->success('Documento salvo com sucesso.', []);
        } catch (TransparencyException $error) {
            return $this->errorWithCode($error->getMessage(), 200, $error->getCode());
        } catch (Exception $error) {
            return $this->error($error->getMessage());
        }
    }

    /**
     * Apaga o ano se não tiver nenhuma sessão relacionada.
     *
     * @param string $folderYearId
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     * @return RedirectResponse
     */
    public function destroyFolderYear(string $folderYearId): RedirectResponse
    {
        try {
            // Recuperando pasta se ela existir.
            $folder                 = TransparencyYear::where('id', $folderYearId)->first();

            // Verifica se a pasta ano foi encontrada.
            if (!$folder) {
                throw new TransparencyException('Não encontrado o ano para exclusão.', 1201);
            }

            // Recuperando sessões dessa pasta.
            $foldersSessions = TransparencyFolders::where('cod_transparency_year_fk', $folderYearId)->get();

            // Verifica se existe uma ou mais sessão na pasta excluída.
            if (count($foldersSessions) >= 1) {
                throw new TransparencyException('Ano não pode ser exluído pois possui sessões relacionados.', 1301);
            }

            // Verifica se a pasta foi excluída corretamente.
            if ($folder->delete()) {
                return redirect()->back()->with([
                    'status'        => true,
                    'message'       => "Ano excluído com sucesso.",
                    'type'          => 'Success',
                ]);
            }

            throw new TransparencyException('Erro na exclusão do ano ou ele não existe.', 1300);
        } catch (TransparencyException $error) {
            return redirect()->back()->with([
                'status'        => false,
                'message'       => $error->getMessage(),
                'type'          => 'Error',
            ]);
        } catch (Exception $error) {
            return redirect()->back()->with([
                'status'        => false,
                'message'       => $error->getMessage(),
                'type'          => 'Error',
            ]);
        }
    }

    /**
     * Exclui uma sesão pasta.
     *
     * @param string $folderSession
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     * @return RedirectResponse
     */
    public function destroySessionFolder(string $folderSession): RedirectResponse
    {
        try {
            // Recuperando pasta sessão para exclusão.
            $folder                 = TransparencyFolders::where('id', $folderSession)->first();

            // Verifica se a pasta existe.
            if (!$folder) {
                throw new TransparencyException('Não encontrada a pasta para exclusão.', 1201);
            }

            // Recuperando arquivos da sessão.
            $files                  = Transparency::where('cod_transparency_folders_fk', $folderSession)->get();

            // Validando se existe um ou mais arquivos dentro da sessão.
            if (count($files) >= 1) {
                throw new TransparencyException('Sessão não excluída pois possuí arquivos relacionados.', 1203);
            }

            // Verifica se a pasta foi excluída corretamente.
            if ($folder->delete()) {
                return redirect()->back()->with([
                    'status'        => true,
                    'message'       => "Sessão excluída com sucesso.",
                    'type'          => 'Success',
                ]);
            }

            throw new TransparencyException('Erro na exclusão da sessão ou ela não existe.', 1202);
        } catch (TransparencyException $error) {
            return redirect()->back()->with([
                'status'        => false,
                'message'       => $error->getMessage(),
                'type'          => 'Error',
            ]);
        } catch (Exception $error) {
            return redirect()->back()->with([
                'status'        => false,
                'message'       => $error->getMessage(),
                'type'          => 'Error',
            ]);
        }
    }

    /**
     * Apaga um arquivo dentro de uma pasta.
     *
     * @param string $fileId
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     * @return RedirectResponse
     */
    public function destroyFilesSession(string $fileId): RedirectResponse
    {
        try {
            // Recuperando pasta para receber o arquivo.
            $file               = Transparency::where('id', $fileId)->first();

            // Verifica se a pasta existe.
            if (!$file) {
                throw new TransparencyException('Não encontrado documento para exclusão.', 1200);
            }

            // Verifica se o arquivo foi excluído.
            if ($file->delete()) {
                // Recuperando storage path
                $storagePath = storage_path('app/public/transparency');

                if (file_exists($storagePath . '/' . $file->filename)) {
                    unlink($storagePath . '/' . $file->filename);
                }

                return redirect()->back()->with([
                    'status'        => true,
                    'message'       => "Documento excluído com sucesso.",
                    'type'          => 'Success',
                ]);
            }

            throw new TransparencyException('Documento não pode ser excluído ou não existe.', 1108);
        } catch (TransparencyException $error) {
            return redirect()->back()->with([
                'status'        => false,
                'message'       => $error->getMessage(),
                'type'          => 'Error',
            ]);
        } catch (Exception $error) {
            return redirect()->back()->with([
                'status'        => false,
                'message'       => $error->getMessage(),
                'type'          => 'Error',
            ]);
        }
    }
}