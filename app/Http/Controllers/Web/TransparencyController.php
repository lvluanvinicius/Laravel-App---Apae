<?php

namespace App\Http\Controllers\Web;

use App\Exceptions\TransparencyException;
use App\Http\Controllers\Controller;
use App\Models\Transparency;
use App\Models\TransparencyFolders;
use App\Models\TransparencyYear;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TransparencyController extends Controller
{
    public function index(): View
    {
        try {
            // Recupera todos as pastas ano.
            $years              = TransparencyYear::orderBy('year_folder', 'desc')->paginate(12);

            return view('pages.website.transparency.index')->with([
                'title'             => env('APP_NAME') . ' | Transparência',
                'subtitle'          => 'Transparência',
                'years'             => $years,
            ]);
        } catch (TransparencyException $error) {
            abort(400, $error->getMessage());
        } catch (Exception $error) {
            abort(400, $error->getMessage());
        }
    }

    public function show(string $folderYearId): View
    {
        try {
            // Recuperando pasta ano.
            $year = TransparencyYear::where('id', $folderYearId)->first(['year_folder']);
            // Recupera todos as pastas do ano.
            $folders = TransparencyFolders::where('cod_transparency_year_fk', $folderYearId)->paginate(12);

            return view('pages.website.transparency.show')->with([
                'title'             => env('APP_NAME') . ' | Transparência',
                'subtitle'          => "Arquivos de " . $year->year_folder,
                'folders'           => $folders,
            ]);
        } catch (TransparencyException $error) {
            abort(400, $error->getMessage());
        } catch (Exception $error) {
            abort(400, $error->getMessage());
        }
    }

    public function showDocuments(string $folderYearId, string $folderId): View
    {
        try {
            // Recupernado pasta.
            $folders = TransparencyFolders::where('id', $folderId)->first();
            // Recupera todos as pastas do ano.
            $files = Transparency::where("cod_transparency_folders_fk", $folderId)->paginate(12);

            return view('pages.website.transparency.documents')->with([
                'title'             => env('APP_NAME') . ' | Transparência',
                'subtitle'          => $folders->folders,
                'files'             => $files,
            ]);
        } catch (TransparencyException $error) {
            abort(400, $error->getMessage());
        } catch (Exception $error) {
            abort(400, $error->getMessage());
        }
    }
}