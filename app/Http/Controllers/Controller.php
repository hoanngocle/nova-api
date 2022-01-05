<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Handle function when API success
     *
     * @param $result
     * @param $msg
     * @return JsonResponse
     */
    public function handleResponse($result, $msg): JsonResponse
    {
        $res = [
            'success'   => true,
            'data'      => $result,
            'message'   => $msg,
        ];
        return response()->json($res, 200);
    }

    /**
     * Handle function when API error
     *
     * @param $error
     * @param array $errorMsg
     * @param int $code
     * @return JsonResponse
     */
    public function handleError($error, array $errorMsg = [], int $code = 404): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        if (!empty($errorMsg)) {
            $response['data'] = $errorMsg;
        }
        return response()->json($response, $code);
    }
}
