<?php


namespace App\Repositories;

use App\Exceptions\SIServicesException;

class SIServicesRepository implements \App\Interfaces\SIServicesRepositoryInterface
{
    /**
     * Recupera os registros.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param string|null|null $search
     * @param integer $paginate
     * @return void
     */
    public function getAll(string|null $search = null, int $paginate = 10, string|null $fileType = null): \Illuminate\Pagination\LengthAwarePaginator
    {
        // Recupera todos os registros em primeiro de acordo o valor do paginate.
        if (!$search)
            return \App\Models\SIServices::paginate($paginate);

        // Recupeta os registros com base no search.
        return \App\Models\SIServices::where('file_name', 'LIKE', "%" . $search . "%")
            ->orWhere('file_public', 'LIKE', "%" . $search . "%")
            ->orWhere('file_type', 'LIKE', "%" . $search . "%")
            ->orWhere('file_name_path', 'LIKE', "%" . $search . "%")
            ->orWhere('file_size', 'LIKE', "%" . $search . "%")
            ->orWhere('file_format', 'LIKE', "%" . $search . "%")
            ->orWhere('file_hash', 'LIKE', "%" . $search . "%")
            ->orWhere('file_device', 'LIKE', "%" . $search . "%")
            ->paginate($paginate);

    }

    /**
     * Recupera um arquivo e o retorna.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param string $pathFile
     * @return \Illuminate\Http\Response
     */
    public function getFile(string $pathFile): \Illuminate\Http\Response
    {
        // Valida se a imagem existe.
        if (!\Illuminate\Support\Facades\Storage::disk('siservices')->exists($pathFile))
            throw new SIServicesException('O arquivo solicitado não existe.');


        $filePath = \Illuminate\Support\Facades\Storage::disk('siservices')->path($pathFile);
        $fileContent = file_get_contents($filePath);
        $type = mime_content_type($filePath);

        return response($fileContent, 200, [
            "Content-Type" => $type,
        ]);

    }

    /**
     * Recura os dados de um registro de arquivo.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param array $ids
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getFileData(array $ids): \Illuminate\Database\Eloquent\Collection
    {
        return (new \App\Models\SIServices())->whereIn('id', $ids)->get();
    }

    /**
     * Efetua a inserção de um registro.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param array $data_file
     * @return boolean
     */
    public static function saveFile(array $data_file): bool
    {
        // Efetua a inserção dos dados.
        $file = \App\Models\SIServices::create($data_file);

        // Valida se a inserção foi efeturada corretamente.
        !$file && throw new SIServicesException('Erro ao tentar salvar o arquivo em banco.');

        return true;
    }
}