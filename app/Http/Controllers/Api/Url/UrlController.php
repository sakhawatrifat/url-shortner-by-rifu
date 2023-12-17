<?php

namespace App\Http\Controllers\Api\Url;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use App\Services\Url\UrlService;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Url;
use Validator;
use Response;

class UrlController extends Controller
{
    private $urlService;

    public function __construct(UrlService $urlService)
    {
        $this->urlService = $urlService;
    }


    public function save(Request $request){
        $validator = Validator::make($request->all(), $this->urlService->isErrorSave($request), $this->urlService->customValidationMessage($request));

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'validation_error' => true,
                'old_data' => $request->all(),
                'message' => $validator->messages()->first(),
            ];

            return response()->json($response, 422); // 422 Unprocessable Entity - Validation error
        }
            
        try {
            $data = $this->urlService->save($request);
            return Response::json([
                'success' => true,
                'message' => 'Url Saved Successfully',
                'data' => $data,
            ], 200); //OK / success / Request Found
        } catch (ValidationException $e) {
            return Response::json([
                'success' => false,
                'message' => 'Something Went Wrong, Please Check All & Try Again.',
            ], 500); //Internal server error
        }
    }
}
