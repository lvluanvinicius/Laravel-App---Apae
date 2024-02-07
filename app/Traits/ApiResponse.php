<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    /**
     * Retorna um response de sucesso.
     *
     * @param array $data
     * @param int $statusCode
     * @return JsonResponse
     */
    public function success(string $message, $data = [], int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'status'            => true,
            'message'           => $message,
            'data'              => $data,
        ], $statusCode);
    }

    /**
     * Retorna um response de erro.
     *
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public function error(string $message, int $statusCode = 400): JsonResponse
    {
        return response()->json([
            'status'            => false,
            'message'           => $message,
        ], $statusCode);
    }

    /**
     * Retorna um response de erro com código de erro customizado.
     *
     * @param string $message
     * @param int $statusCode
     * @param int $errorCode
     * @return JsonResponse
     */
    public function errorWithCode(string $message, int $statusCode = 400, int $errorCode = 1): JsonResponse
    {
        return response()->json([
            'status'            => false,
            'message'           => $message,
            'errorCode'         => $errorCode,
        ], $statusCode);
    }

    /**
     * Retorna um response de warning.
     *
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public function warning(string $message, int $statusCode = 401): JsonResponse
    {
        return response()->json([
            'status'            => true,
            'warning'           => $message,
        ], $statusCode);
    }

    /**
     * Retorna um response de info.
     *
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public function info(string $message, int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'status'            => true,
            'info'              => $message,
        ], $statusCode);
    }

    /**
     * Retorna um response de not found.
     *
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public function notFound(string $message, int $statusCode = 404): JsonResponse
    {
        return response()->json([
            'status'            => false,
            'message'           => $message,
        ], $statusCode);
    }

    /**
     * Retorna um response de unauthorized.
     *
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public function unauthorized(string $message, int $statusCode = 401): JsonResponse
    {
        return response()->json([
            'status'            => false,
            'message'           => $message,
        ], $statusCode);
    }

    /**
     * Retorna um response de forbidden.
     *
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public function forbidden(string $message, int $statusCode = 403): JsonResponse
    {
        return response()->json([
            'status'            => false,
            'message'           => $message,
        ], $statusCode);
    }

    /**
     * Retorna um response de too many requests.
     *
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public function tooManyRequests(string $message, int $statusCode = 429): JsonResponse
    {
        return response()->json([
            'status'            => false,
            'message'           => $message,
        ], $statusCode);
    }

    /**
     * Response de erro com mais detalhes
     *
     * @param string $message
     * @param integer $statusCode
     * @param array $details
     * @return JsonResponse
     */
    public function errorWithDetails(string $message, int $statusCode = 400, array $details = []): JsonResponse
    {
        return response()->json([
            'status'            => false,
            'message'           => $message,
            'details'           => $details,
        ], $statusCode);
    }

    /**
     * Response de erro com código de erro personalizado
     *
     * @param string $message
     * @param integer $statusCode
     * @param string $customCode
     * @return JsonResponse
     */
    public function errorWithCustomCode(string $message, int $statusCode = 400, string $customCode): JsonResponse
    {
        return response()->json([
            'status'            => false,
            'message'           => $message,
            'errorCode'         => $customCode,
        ], $statusCode);
    }

    /**
     * Response de erro com dados adicionais
     *
     * @param string $message
     * @param integer $statusCode
     * @param array $data
     * @return JsonResponse
     */
    public function errorWithData(string $message, int $statusCode = 400, array $data = []): JsonResponse
    {
        return response()->json([
            'status'            => false,
            'message'           => $message,
            'data'              => $data,
        ], $statusCode);
    }

    /**
     * Response de erro com status code personalizado
     *
     * @param string $message
     * @param integer $statusCode
     * @return JsonResponse
     */
    public function errorWithStatusCode(string $message, int $statusCode): JsonResponse
    {
        return response()->json([
            'status'            => false,
            'message'           => $message,
        ], $statusCode);
    }

    /**
     * Response de erro com status code e código de erro personalizados
     *
     * @param string $message
     * @param integer $statusCode
     * @param string $customCode
     * @return JsonResponse
     */
    public function errorWithStatusCodeAndCode(string $message, int $statusCode, string $customCode): JsonResponse
    {
        return response()->json([
            'status'            => false,
            'message'           => $message,
            'errorCode'         => $customCode,
        ], $statusCode);
    }

    /**
     * Retorna resposta com array de erros de respostas na requests customizadas.
     *
     * @param string $message
     * @param integer $statusCode
     * @param string $errors
     * @return void
     */
    public function withErrors(string $message, int $statusCode, string $errors)
    {
        return response()->json([
            'status'            => false,
            'message'           => $message,
            'errors'            => $errors,
        ], $statusCode);
    }
}