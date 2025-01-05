<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use App\Models\DeliveryBoy;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class BaseController extends Controller
{
    protected $userServerKey;
    public function __construct()
    {
        $this->userServerKey = env('USER_FCM_KEY');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($message = '', $result = [])
    {
        $response = [
            'message' => $message,
            'data' => (empty($result)) ? [] : $result,
            'success' => true,
        ];

        return response()->json($response, 200);
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponseWithToken($token = "", $message = '', $result = [])
    {
        $response = [
            'token' => $token,
            'message' => $message,
            'data' => (empty($result)) ? [] : $result,
            'success' => true,
        ];

        return response()->json($response, 200);
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendSweetAlertSuccess($title = "", $message = '')
    {
        $response = [
            'title' => $title,
            'message' => $message,
            'response' => "success",
            'success' => true,
        ];
        return response()->json($response, 200);
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendSweetAlertError($title = "", $message = '', $hint = "")
    {
        $response = [
            'title' => $title,
            'message' => $message,
            'hint' => $hint,
            'response' => "error",
            'success' => false,
        ];
        return response()->json($response, 400);
    }



    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendSuccess($message = '')
    {
        $response = [
            'message' => $message,
            'success' => true,
        ];

        return response()->json($response, 200);
    }

    /**
     * error response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $code = 400)
    {
        $response = [
            'message' => $error,
            'success' => false,
        ];

        return response()->json($response, $code);
    }




}
