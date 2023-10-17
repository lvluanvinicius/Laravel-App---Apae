<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\TransparencyException;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransparencyRequest;
use App\Models\Transparency;
use App\Models\TransparencyFolders;
use App\Models\TransparencyYear;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TransparencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $years              = TransparencyYear::orderBy('year_folder', 'desc')->get();

        $dataTransparency   = [];

        // Recuperando valores das pastas pais de anos.
        foreach($years as $y) {
            // Recuperando as pastas.
            $folders = TransparencyFolders::where('cod_transparency_year_fk', $y->id)->get(['id', 'cod_transparency_year_fk','folders', 'hash']);

            $newFolders = [];
            foreach($folders as $fd) {
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
            
            array_push ($dataTransparency, $nData);
        }

        // return $dataTransparency;

        return view('pages.admin.transparency.index')->with([
            'title'             => "Portal da Transparência",
            'transparency'      => $dataTransparency,
        ]);
    }

    public function createFolderSession(string $folderYearId) 
    {
        $year                   = TransparencyYear::where('id', $folderYearId)->first();
        return view('pages.admin.transparency.addsession')->with([
            'title'             => "Nova Sessão",
            'year'              => $year,
        ]);
    }

   
    /**
     * Efetua a inserção de um novo ano dentro da transparência.
     *
     * @param TransparencyRequest $request
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
}


// // Gaurda a hash que ira usar na pasta.
// $hashString = "";

// // Gerando uma has para o arquivo.
// $validate = true;
// while ($validate) {
//     // Gerando Hash.
//     $s = md5($foldName . rand(100, 100000000));

//     // Checa se existe a hash gerada, se não existir irá parar o loop e salvar em banco.
//     if (!TransparencyFolders::where('hash', $s)->first()) {
//         $hashString = $s;
//         $validate = false;
//     }
// }