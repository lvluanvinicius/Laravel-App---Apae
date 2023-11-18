<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\PhotoGalleryException;
use App\Http\Controllers\Controller;
use App\Http\Requests\PhotoGalleryAlbumRequest;
use App\Http\Requests\PhotoGalleryAlbumUpdateRequest;
use App\Models\PhotoGalleryAlbum;
use App\Models\PhotoGalleryFiles;
use App\Models\Settings;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PhotoGalleryController extends Controller
{
    use ApiResponse;

    /**
     * Exibe a listagem dos albuns.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     * @return void
     */
    public function index()
    {
        // Recuperando dados da galeria.
        $albuns = PhotoGalleryAlbum::paginate(8);

        return view('pages.admin.photo-gallery.index')->with([
            'title'             => 'Galeria de Fotos',
            'albuns'            => $albuns,
        ]);
    }

    /**
     * Abre o display para criação de um novo album de fotos.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     * @return void
     */
    public function createAlbum()
    {
        return view('pages.admin.photo-gallery.create-album')->with([
            'title'             => 'Galeria de Fotos',
        ]);
    }

    /**
     * Salva um novo album de fotos.
     *
     * @param PhotoGalleryAlbumRequest $request
     * 
     * @author Luan Santos <lvluansantos@gmail.com>
     * @return RedirectResponse
     */
    public function storeAlbum(PhotoGalleryAlbumRequest $request): RedirectResponse
    {
        try {
            // Recuperando valores.
            $album = $request->all();
            $image = $request->file('gallery_cover'); # Recupera a imagem da capa.

            // Verificando se foi encaminhado um arquivo.
            if (!$request->hasFile('gallery_cover')) {
                throw new PhotoGalleryException('Informe uma imagem.', 1100);
            }

            // Validando se é um arquivo.
            if (!$request->file('gallery_cover')->isValid()) {
                throw new PhotoGalleryException('Informe uma imagem válida.', 1101);
            }

            $ext                    = $image->getClientOriginalExtension(); # Recupera a extensão do arquivo.
            $imageName              = explode('.', $image->getClientOriginalName())[0];  # Recupera o nome do arquivo enviado.
            $imageSize              = $image->getSize(); # Recupera o tamanho do arquivo.
            $imageType              = $image->getType(); # Recupera o tipo do arquivo.

            // Recuperando extensões aceitas.
            $imageExtensions = Settings::where('setting_name', 'application_gallery_extensions')->first('setting_value');

            $validadeExt = array_filter(unserialize($imageExtensions->setting_value), function ($acceptExt) use ($ext) {
                if ($acceptExt == $ext) return true;
                return false;
            });

            // Verifica se a extensão é válida.
            if (!$validadeExt) {
                throw new PhotoGalleryException("Verifique a extensão do documento, são aceito apenas '" . join('|', unserialize($imageExtensions->setting_value)) . "'");
            }

            // Gerando Hash para a imagem do album.
            $hashString             = "";
            $f                      = true;
            while ($f) {
                $s                  = $imageName . '-' .md5($imageName . rand(100, 1000000)); # Gerando a hash.
                $hashExits          = PhotoGalleryAlbum::where('gallery_hash', $s)->first(); # Recupera se já existir para recriar.

                if (!$hashExits) {
                    $f              = false; # Altera a flag se a hash não existir.
                    $hashString     = $s;    # Salvando a hash.
                }
            }

            // Criando novo album.
            $gallery = PhotoGalleryAlbum::create([
                "gallery_name"                      => $album["gallery_name"],
                "gallery_description"               => $album["gallery_description"],
                "gallery_hash"                      => $hashString,
                "gallery_image"                     => $hashString . "." . $ext,
                "gallery_size"                      => $imageSize,
                "gallery_format"                    => $imageType,
            ]);

            // Verifica se o album foi criado corretamente.
            if ($gallery) {

                // Recupera o path nas configurações.
                $locationPath = Settings::where('setting_name', 'application_gallery_path')->first('setting_value');

                // Salvando arquivo no diretório.
                $image->move($locationPath->setting_value,  $hashString . "." . $ext);

                return redirect()->route('admin.photos-gallery.index')->with([
                    'status'        => true,
                    'message'       => "Album criado com sucesso.",
                    'type'          => 'Success',
                ]);
            }

            throw new PhotoGalleryException('Não foi possível criar o algum.');
        } catch (PhotoGalleryException $error) {
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
     * Exibe display com as imagens do album.
     *
     * @param string $galleryId
     * 
     * @author Luan Santos <lvluansantos@gmail.com>
     *  @return RedirectResponse|View
     */
    public function viewGallery(string $galleryId): RedirectResponse|View
    {
        try {
            // Recuperando Album.
            $gallery = PhotoGalleryAlbum::where('id', $galleryId)->first();

            // Recuperando imagens.
            $images = PhotoGalleryFiles::where('cod_photo_gallery_fk', $gallery->id)->get();

            return view('pages.admin.photo-gallery.view-gallery')->with([
                'title'         => $gallery->gallery_name,
                'images'        => $images,
                'gallery'       => $gallery,
            ]);
        } catch (PhotoGalleryException $error) {
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
     *  Exibe o display de registro de novas imagens para o album.
     *
     * @param Request $request
     * @param string $galleryId
     * 
     * @author Luan Santos <lvluansantos@gmail.com>
     * @return RedirectResponse|View
     */
    public function addImage(Request $request, string $galleryId): RedirectResponse|View
    {
        try {
            // Recuperando Album.
            $gallery = PhotoGalleryAlbum::where('id', $galleryId)->first();

            return view('pages.admin.photo-gallery.addimages')->with([
                'title'         => $gallery->gallery_name,
            ]);
        } catch (PhotoGalleryException $error) {
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
     * Insere uma nova imagem dentro de um album. 
     *
     * @param Request $request
     * @param string $galleryId
     * 
     * @author Luan Santos <lvluansantos@gmail.com>
     * @return JsonResponse
     */
    public function createNewFileImage(Request $request, string $galleryId): JsonResponse
    {
        try {
            // Recuperando Album.
            $gallery = PhotoGalleryAlbum::where('id', $galleryId)->first();

            // Validando se encontrou o album para receber as imagens.
            if (!$gallery) {
                throw new PhotoGalleryException('Não encontrado album para upload da imagem.');
            }

            // Verificando se foi encaminhado um arquivo.
            if (!$request->hasFile('file')) {
                throw new PhotoGalleryException('Informe uma imagem.');
            }

            // Validando se é um arquivo.
            if (!$request->file('file')->isValid()) {
                throw new PhotoGalleryException('Informe uma imagem válido.');
            }

            // Recuperando arquivo.
            $file               = $request->file('file');
            $ext                = $file->getClientOriginalExtension();
            $fileName           = explode('.', $file->getClientOriginalName())[0];
            $fileSize           = $file->getSize();
            $typeFile           = $file->getType();

            // Validando extensão. 
            $setting = Settings::where('setting_name', 'application_gallery_extensions')->first('setting_value');
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
                throw new PhotoGalleryException("Verifique a extensão da imagem, são aceito apenas '" . join('|', $extensions) . "'");
            }

            /**
             * Salvando dados do arquivo em base. 
             */
            $hashString     = "";               # Gaurda a hash que ira usar na pasta.

            // Gerando uma has para o arquivo.
            $validate = true;
            while ($validate) {
                // Gerando Hash.
                $s = $fileName . '-' . md5($fileName . rand(100, 100000000));

                // Checa se existe a hash gerada, se não existir irá parar o loop e salvar em banco.
                if (!PhotoGalleryFiles::where('hash', $s)->first()) {
                    $hashString = $s;
                    $validate = false;
                }
            }

            // Recuperando storage path
            $storagePath = Settings::where('setting_name', 'application_gallery_path')->first('setting_value');

            // Salvando arquivo no diretório.
            $path = $file->move("{$storagePath->setting_value}/albuns", $hashString . "." . $ext);
            // Verifica se o arquivo fora salvo com sucesso.
            if (!$path) {
                throw new PhotoGalleryException('Erro ao tentar salvar a imagem ou diretório é inexistente.');
            }

            // Inserindo na base.
            $fileSave = PhotoGalleryFiles::create([
                'cod_photo_gallery_fk'                  => $gallery->id,
                'filename'                              => $hashString . "." . $ext,
                'hash'                                  => $hashString,
                'type_file'                             => $typeFile,
                'size_file'                             => $fileSize,
            ]);

            // Verifica se o arquivo foi salvo corretamente.
            if (!$fileSave) {
                // Exclui o arquivo no diretório se não for salvo em base.
                unlink("{$storagePath->setting_value}/albuns/{$hashString}.{$ext}");

                throw new PhotoGalleryException('Não foi possível salvar a imagem na base de dados.');
            }

            return $this->success('Imagem salva com sucesso.', []);
        } catch (PhotoGalleryException $error) {
            return $this->errorWithCode($error->getMessage(), 200, $error->getCode());
        } catch (Exception $error) {
            return $this->error($error->getMessage());
        }
    }

    /**
     * Abre o display de edição do album.
     *
     * @param string $galleryId
     * 
     * @author Luan Santos <lvluansantos@gmail.com>
     * @return view|RedirectResponse
     */
    public function editGallery(string $galleryId): view|RedirectResponse
    {
        try {
            // Recuperando album para exclusão.
            $gallery = PhotoGalleryAlbum::where('id', $galleryId)->first();

            // Validando se existe o album. 
            if (!$gallery) {
                throw new PhotoGalleryException('A Galeria não existe.');
            }

            return view('pages.admin.photo-gallery.edit-album')->with([
                'title'             => 'Editar album',
                'gallery'           => $gallery,
            ]);
        } catch (PhotoGalleryException $error) {
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
     * Efetua update do album. 
     *
     * @param PhotoGalleryAlbumUpdateRequest $request
     * @param string $galleryId
     * 
     * @author Luan Santos <lvluansantos@gmail.com>
     * @return RedirectResponse
     */
    public function updateAlbum(PhotoGalleryAlbumUpdateRequest $request, string $galleryId): RedirectResponse
    {
        try {
            // Recuperando Album.
            $gallery = PhotoGalleryAlbum::where('id', $galleryId)->first();

            // Validando se encontrou o album para receber as imagens.
            if (!$gallery) {
                throw new PhotoGalleryException('Não encontrado album para atualização.');
            }

            // Recuperando valores.
            $album = $request->all();
            $image = $request->file('gallery_cover'); # Recupera a imagem da capa.

            // Verificando se foi encaminhado um arquivo.
            if ($request->hasFile('gallery_cover')) {
                // Validando se é um arquivo.
                if (!$request->file('gallery_cover')->isValid()) {
                    throw new PhotoGalleryException('Informe uma imagem válida.', 1101);
                }

                $ext                    = $image->getClientOriginalExtension(); # Recupera a extensão do arquivo.
                $imageName              = explode('.', $image->getClientOriginalName())[0];  # Recupera o nome do arquivo enviado.
                $imageSize              = $image->getSize(); # Recupera o tamanho do arquivo.
                $imageType              = $image->getType(); # Recupera o tipo do arquivo.

                // Recuperando extensões aceitas.
                $imageExtensions = Settings::where('setting_name', 'application_gallery_extensions')->first('setting_value');

                $validadeExt = array_filter(unserialize($imageExtensions->setting_value), function ($acceptExt) use ($ext) {
                    if ($acceptExt == $ext) return true;
                    return false;
                });

                // Verifica se a extensão é válida.
                if (!$validadeExt) {
                    throw new PhotoGalleryException("Verifique a extensão do documento, são aceito apenas '" . join('|', unserialize($imageExtensions->setting_value)) . "'");
                }

                // Gerando Hash para a imagem do album.
                $hashString             = "";
                $f                      = true;
                while ($f) {
                    $s                  = $imageName . '-' . md5($imageName . rand(100, 1000000)); # Gerando a hash.
                    $hashExits          = PhotoGalleryAlbum::where('gallery_hash', $s)->first(); # Recupera se já existir para recriar.

                    if (!$hashExits) {
                        $f              = false; # Altera a flag se a hash não existir.
                        $hashString     = $s;    # Salvando a hash.
                    }
                }

                // Salva o nome anttigo da imagem para assim excluir.
                $beforeNameFile                             = $gallery->gallery_image;

                // Atualizado lalbum.
                $gallery->gallery_name                      = $album["gallery_name"];
                $gallery->gallery_description               = $album["gallery_description"];
                $gallery->gallery_hash                      = $hashString;
                $gallery->gallery_image                     = $hashString . "." . $ext;
                $gallery->gallery_size                      = $imageSize;
                $gallery->gallery_format                    = $imageType;


                // Verifica se o album foi criado corretamente.
                if ($gallery->save()) {

                    // Recupera o path nas configurações.
                    $locationPath = Settings::where('setting_name', 'application_gallery_path')->first('setting_value');

                    // Apagando imagem anterior
                    if (file_exists("{$locationPath->setting_value}/{$beforeNameFile}")) {
                        unlink("{$locationPath->setting_value}/{$beforeNameFile}");
                    }

                    // Salvando nova imagem.
                    $image->move($locationPath->setting_value,  $hashString . "." . $ext);

                    return redirect()->route('admin.photos-gallery.view-gallery', ['galleryId' => $galleryId])->with([
                        'status'        => true,
                        'message'       => "Album atualizado com sucesso.",
                        'type'          => 'Success',
                    ]);
                }

                throw new PhotoGalleryException('Não foi possível atualzar o algum.');
            } else {
                // Atualizando album.                
                $gallery->gallery_name                      = $album["gallery_name"];
                $gallery->gallery_description               = $album["gallery_description"];

                // Verifica se o album foi criado corretamente.
                if ($gallery->save()) {
                    return redirect()->route('admin.photos-gallery.view-gallery', ['galleryId' => $galleryId])->with([
                        'status'        => true,
                        'message'       => "Album atualizado com sucesso.",
                        'type'          => 'Success',
                    ]);
                }
            }

            throw new PhotoGalleryException('Não foi possível criar o algum.');
        } catch (PhotoGalleryException $error) {
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
     * Exclui o album. 
     *
     * @param string $galleryId
     * 
     * @author Luan Santos <lvluansantos@gmail.com>
     * @return RedirectResponse
     */
    public function destroyGalleryAlbum(string $galleryId): RedirectResponse
    {
        try {
            // Recuperando album para exclusão.
            $gallery = PhotoGalleryAlbum::where('id', $galleryId)->first();

            // Validando se existe o album. 
            if (!$gallery) {
                throw new PhotoGalleryException('A Galeria não existe.');
            }

            // Validando se existem imagens associadas.
            $images = PhotoGalleryFiles::where('cod_photo_gallery_fk', $gallery->id)->get();

            // Valida se retornou imagens do album.
            if (count($images) >= 1) {
                throw new PhotoGalleryException('A Galeria possui imagens e não pode ser excluída.');
            }

            // Recuperando path da imagem.
            $imagePath =  Settings::where('setting_name', 'application_gallery_path')->first('setting_value');

            // Apagando album e validando exclusão. 
            if ($gallery->delete()) {
                // Excluindo capa do album. 
                if (file_exists("{$imagePath->setting_value}/{$gallery->gallery_image}")) {
                    unlink("{$imagePath->setting_value}/{$gallery->gallery_image}");
                }

                return redirect()->route('admin.photos-gallery.index')->with([
                    'status'        => true,
                    'message'       => "Album excluído com sucesso.",
                    'type'          => 'Success',
                ]);
            }
        } catch (PhotoGalleryException $error) {
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
     * Efetua a exclusão de uma imagem no album.
     *
     * @param string $imageId
     * 
     * @author Luan Santos <lvluansantos@gmail.com>
     * @return RedirectResponse
     */
    public function destroyImage(string $imageId): RedirectResponse
    {
        try {
            // Recuperando imagem
            $image = PhotoGalleryFiles::where('id', $imageId)->first();

            // Verificando se a imagem existe. 
            if (!$image) {
                throw new PhotoGalleryException('Imagem não encontrada para exclusão.');
            }

            // Recuperando storage path
            $storagePath = Settings::where('setting_name', 'application_gallery_path')->first('setting_value');

            // Efetuando a exclusão e validando se foi efetuada.
            if ($image->delete()) {
                if (file_exists("{$storagePath->setting_value}/albuns/{$image->filename}")) {
                    unlink("{$storagePath->setting_value}/albuns/{$image->filename}");
                }

                return redirect()->back()->with([
                    'status'        => true,
                    'message'       => "Imagem excluída com sucesso.",
                    'type'          => 'Success',
                ]);
            }

            throw new PhotoGalleryException('Não foi possível excluír a imagem ou não foi encontrada.');
        } catch (PhotoGalleryException $error) {
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
