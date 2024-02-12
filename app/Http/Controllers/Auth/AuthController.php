<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\AuthException;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use \App\Traits\AppResponse;


    /**
     * Efetua a autenticação do usuário dentro do painel.
     *
     * @author Luan Santos <lvluansantos@gmail.com>
     *
     * @param AuthRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginDo(AuthRequest $request): \Illuminate\Http\RedirectResponse
    {
        try {
            // Recupernado usuário.
            $user = User::where('email', $request->email)->first(['email', 'is_client']);

            // Verifica se algum usuário foi encontrado.
            if (!$user) {
                throw new AuthException('Usuário ou senha estão incorretos.');
            }

            // Autentica o usuário no gaurdian de clientes se o mesmo for um cliente(contribuidor).
            if ($user->is_client) {
                // Efetuando login do usuário no guardian de clientes(contribuidor)
                if (!Auth::guard('client')->attempt(['email' => $request->email, 'password' => $request->password])) {
                    throw new AuthException('Usuário ou senha estão incorretos.');
                }

                return redirect()->route('client.index');
            } else {
                // Efetuando login do usuário.
                if (!Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
                    throw new AuthException('Usuário ou senha estão incorretos.');
                }

                return redirect()->route('admin.index');
            }

            throw new AuthException('Usuário ou senha estão incorretos.');
        } catch (AuthException $error) {
            return $this->redirectError($error->getMessage(), 200, []);
        }
    }
}