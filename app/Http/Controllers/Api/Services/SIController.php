<?php

namespace App\Http\Controllers\Api\Services\SI;

use App\Exceptions\SIServicesException;
use App\Http\Controllers\Controller;
use App\Http\Requests\SIServicesCreateRequest;
use App\Utils\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class SIController extends Controller
{
    use ApiResponse;

    /**
     * Guarda todos os IPs que possuem permissão.
     *
     * @var array
     */
    protected array $whiteList;

    /**
     * Controlador de inicialização.
     */
    public function __construct()
    {
        // Iniciando Endereços IPs permitidos para busca de determinados tipos de imagens.
        $this->whiteList = [
            '10.254.192.180',
            '10.254.192.175',
        ];
    }

    /**
     * Recupera todos os registros do si services.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param \App\Repositories\SIServicesRepository $sIServicesRepository
     * @param Request $request
     * @return JsonResponse
     */
    public function index(\App\Repositories\SIServicesRepository $sIServicesRepository, Request $request): JsonResponse
    {
        try {
            // Recuperando parametros.
            $search = $request->has('search') ? $request->get('search') : null;
            $paginate = $request->has('paginate') ? $request->get('paginate') : 10;

            $services = $sIServicesRepository->getAll($search, $paginate);
            return $this->success($services);
        } catch (SIServicesException $error) {
            return $this->error($error->getMessage(), Response::HTTP_OK);
        } catch (Exception $error) {
            return $this->error($error->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Recupera o contente de um arquivo e retorna o arquivo.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param string $pathFile
     * @return Response|JsonResponse
     */
    public function getFileContent(\App\Repositories\SIServicesRepository $sIServicesRepository, string $pathFile): Response|JsonResponse
    {

        try {
            // Recuperando imagens no path de website.
            return $sIServicesRepository->getFile($pathFile);
        } catch (SIServicesException $error) {
            return $this->error($error->getMessage(), Response::HTTP_OK);
        } catch (Exception $error) {
            return $this->error($error->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Efetua o upload e salva em SiServices o arquivo.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param \App\Repositories\SIServicesRepository $sIServicesRepository
     * @param SIServicesCreateRequest $request
     * @return JsonResponse
     */
    public function uploadFiles(\App\Repositories\SIServicesRepository $sIServicesRepository, SIServicesCreateRequest $request): JsonResponse
    {
        try {
            // Valida se é um arquivo.
            if ($request->hasfile('files')) {
                // Recupera todos os arquivos.
                $files = $request->file('files');

                // Recuperando extensões aceitas.
                $setting = \App\Models\Settings::where('setting_name', 'app_si_services_extensions')->first('setting_value');
                $extensions = unserialize($setting->setting_value);

                // Validando as extensões.
                foreach ($files as $file) {
                    // Recupera a estensão do arquivo.
                    $ext = $file->getClientOriginalExtension();

                    // Filtrando se as extensões estão dentro do permitido.
                    $validade = array_filter($extensions, function ($extension) use ($ext) {
                        if ($ext === $extension)
                            return $ext;
                    });

                    // Valida se a estensão está dentro do permitido.
                    count($validade) <= 0 && throw new SIServicesException("São aceitos apenas as extensões '" . join('|', $extensions) . "'.");
                }

                // Recuperando tamanho de arquivo aceito.
                $setting = \App\Models\Settings::where('setting_name', 'app_si_services_size')->first('setting_value');
                $acceptSize = unserialize($setting->setting_value);

                // Valida o tamanho da imagem.
                foreach ($files as $file) {
                    $size = $file->getSize();
                    $mimeType = $file->getClientMimeType();
                    $fileName = $file->getClientOriginalName();

                    // Filtrando se o parâmetro para o tipo de arquivo está configurado.
                    $ac = array_filter($acceptSize, function ($ac) use ($mimeType) {
                        if (explode('/', $mimeType)[0] === explode(':', $ac)[0])
                            return $ac;
                    });



                    // Valida se as configurações de validação de tamanho do arquivo específico foi definida.
                    count($ac) <= 0 && throw new SIServicesException("Não encontrado parâmetro de validação para o tipo de arquivo '" . $mimeType . "'.");

                    // Validando tamanho do arquivo.
                    if (floatval(explode(':', $ac[0])[1]) < $size)
                        throw new SIServicesException("O tamanho do arquivo " . $fileName . " é maior que o permitido " . round(floatval(explode(':', $ac[0])[1]) / 1000000, 1, PHP_ROUND_HALF_UP) . "MB.");
                }

                // Efetuando Upload dos arquivos.
                foreach ($files as $file) {
                    // Cria o array para inserção dos arquivos.
                    $fileData = [
                        "file_name" => explode('.', $file->getClientOriginalName())[0],
                        "file_type" => explode('/', $file->getMimeType())[0],
                        "file_name_path" => $file->getClientOriginalName(),
                        "file_size" => $file->getSize(),
                        "file_format" => $file->getType(),
                        "file_hash" => md5($file->getClientOriginalName() . rand(0, 100000000000000)),
                    ];

                    // Efetuando upload da imagem no path.
                    $siPath = env('SI_PATH');

                    // Validando se o arquivo ja existe.
                    file_exists("$siPath/" . $fileData['file_name_path']) && throw new SIServicesException("O arquivo " . $fileData['file_name_path'] . " já existe.");

                    // Efetuando o upload do arquivo e validando.
                    !$file->move($siPath, $fileData['file_name_path']) && throw new SIServicesException("Erro ao tentar gravar o arquivo " . $fileData['file_name_path'] . " dentro do storage.");

                    // Efetuando a inserção do dados dentro do banco.
                    \App\Repositories\SIServicesRepository::saveFile($fileData);
                }

                return $this->success([], 'Arquivos foram salvos com sucesso.');
            }

            throw new SIServicesException('Os arquivos enviados são inválidos ou vazio.');

        } catch (SIServicesException $error) {
            return $this->error($error->getMessage(), Response::HTTP_OK);
        } catch (Exception $error) {
            return $this->error($error->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}