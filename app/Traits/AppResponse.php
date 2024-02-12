<?php


namespace App\Traits;

/*
|--------------------------------------------------------------------------
| Api Responser Trait
|--------------------------------------------------------------------------
|
| This trait will be used for any response we sent to clients.
|
*/

trait AppResponse
{

    /**
     * Return a success DATA response.
     *
     * @param array $data
     * @param string|null $message
     * @param string|null $troute
     * @param integer $code
     * @return void
     */
    protected function redirectSuccess(string $message = null, int $code = 200, $data = ""): \Illuminate\Http\RedirectResponse
    {
        return redirect()->back()->with([
            "status" => true,
            "type" => 'success',
            "message" => $message,
            "data" => $data,
        ], $code);
    }

    /**
     * Return an error DATA response.
     *
     * @param string|null $message
     * @param string $troute
     * @param integer $code
     * @param array $data
     * @return void
     */
    protected function redirectError(string $message = null, int $code, $data = null): \Illuminate\Http\RedirectResponse
    {
        ///
        return redirect()->back()->with([
            "status" => false,
            'type' => 'error',
            'message' => $message,
        ], $code)->withInput();
    }

    /**
     * Retornar status de informação
     *
     * @param string|null $message
     * @param string $troute
     * @param integer $code
     * @param array $data
     * @return void
     */
    protected function redirectInfo(string $message = null, int $code, $data = null): \Illuminate\Http\RedirectResponse
    {
        return redirect()->back()->with([
            "status" => false,
            'type' => 'info',
            'message' => $message,
        ], $code)->withInput();
    }

    /**
     * Retiorna mensagem de aviso
     *
     * @param string|null $message
     * @param string $troute
     * @param integer $code
     * @param array $data
     * @return void
     */
    protected function redirectWarning(string $message = null, string $troute, int $code, $data = null): \Illuminate\Http\RedirectResponse
    {
        return redirect()->back()->with([
            "status" => false,
            'type' => 'warning',
            'message' => $message,
        ], $code)->withInput();
    }

}