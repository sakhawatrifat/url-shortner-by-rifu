<?php

namespace App\Http\Controllers\Backend\Url;

use App\Http\Controllers\Controller;
use App\Services\Url\UrlService;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Url;
use Auth;

class UrlController extends Controller
{
    private $urlService;

    public function __construct(UrlService $urlService)
    {
        $this->urlService = $urlService;
    }

    public function authUser(){
        return Auth::guard('admin')->user();
    }

    public function index(Request $request){
        if ($request->ajax()) {
            $data = $this->urlService->getList($request , $this->authUser());
            return $data;
        }
        $users = User::get();
        return view('backend.url.index', get_defined_vars());
    }


    public function save(Request $request){
        if ($request->ajax()) {
            try {
                $this->validate($request, $this->urlService->isErrorSave($request), $this->urlService->customValidationMessage($request));
            } catch (ValidationException $e) {
                $response = [
                    'success' => 0,
                    'validation_error' => 1,
                    'errors' => $e->errors()
                ];
                return response()->json($response, 422); // 422 Unprocessable Entity - Validation error
            }

            $data = $this->urlService->save($request, $this->authUser());
            return $data;
        }

        return redirect(route('admin.url.index'));
    }

    public function edit(Request $request, $slug){
        if ($request->ajax()) {
            $data = $this->urlService->details($slug, $this->authUser());
            if (!$data) {
                $response = [
                    'success' => 0,
                    'message' => 'Data not found!',
                ];
                return $response;
            }

            $response = [
                'success' => 1,
                'data' => $data,
            ];
            return $response;
        }

        return redirect(route('admin.url.index'));
    }


    public function destroy(Request $request, $slug){
        if ($request->ajax()) {
            $data = $this->urlService->details($slug, $this->authUser());
            if (!$data) {
                $response = [
                    'success' => 0,
                    'message' => 'Data not found!',
                ];
                return $response;
            }

            $data = $this->urlService->destroy($slug, $this->authUser());
            return true;
        }

        return redirect(route('admin.url.index'));
    }
}
