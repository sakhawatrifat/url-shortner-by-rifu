<?php

namespace App\Services\Url;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Models\Url;
use DataTables;
use Auth;

class UrlService
{

    public function getList($request)
    {
        if(Auth::user()){
            $data = Url::whereUserId(Auth::user()->id)->select('*');
        }else{
            $data = Url::select('*');
        }
        if(isset($request->order[0]) && $request->order[0]['column'] == 0){
            $data = $data->orderBy('id', 'desc');
        }
        $listData = Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('user_id', function($row){
                return $row->user ? $row->user->name : 'Unknown';
            })
            ->addColumn('original_url', function($row){
                return strlen($row->getRawOriginal('original_url')) > 40 ? substr($row->getRawOriginal('original_url'), 0, 40) . '....' : substr($row->getRawOriginal('original_url'), 0, 40);
            })
            ->addColumn('generated_url', function($row){
                $generatedUrl = getBaseURL().$row->generated_url;
                return strlen($generatedUrl) > 30 ? substr($generatedUrl, 0, 30) . '....' : substr($generatedUrl, 0, 30);
            })
            ->addColumn('action', function($row){
                if(Auth::user()){
                    $data = Url::whereUserId(Auth::user()->id)->select('*');
                    $editRoute = route('user.url.edit', $row->slug);
                    $destroyRoute = route('user.url.destroy', $row->slug);
                }else{
                    $data = Url::select('*');
                    $editRoute = route('admin.url.edit', $row->slug);
                    $destroyRoute = route('admin.url.destroy', $row->slug);
                }
                $btn = '<div class="dt-table-btn-wrap">';
                $btn .= '<a title"Browse" class="browse-url-btn dt-table-btn mx-1 mb-1 btn btn-secondary btn-sm" target="_blank" href="'.getBaseURL().$row->generated_url.'"><em class="text-light icon ni ni-globe"></em></a>';
                $btn .= '<a title="Copy Generated Url" class="copy-data-text-btn dt-table-btn mb-1 btn btn-info btn-sm" data-text="'.getBaseURL().$row->generated_url.'"><em class="text-light icon ni ni-copy"></em></a>';
                $btn .= '<a title"Edit" class="edit-data-btn dt-table-btn mx-1 mb-1 btn btn-primary btn-sm" onclick="loadModal(\''.$editRoute.'\', \''.$row->slug.'\')"><em class="text-light icon ni ni-edit-alt"></em></a>';
                $btn .= '<a title"Delete" class="delete-data-btn dt-table-btn mb-1 btn btn-danger btn-sm" delete-url="'.$destroyRoute.'"><em class="text-light icon ni ni-trash-alt"></em></a>';
                $btn .= '</div>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);

        return $listData;
    }

    public function save($request)
    {
        if(isset($request->slug)){
            $myModel = $this->details($request->slug);
            $myModel->slug = $request->slug;
            $myModel->generated_url = $request->generated_url ?? $myModel->generated_url;
        }else{
            $myModel = new Url();
            $myModel->slug = generateRandomNumber(10);
            $myModel->generated_url = Str::random(8);
        }
        DB::beginTransaction();
        try {
            $myModel->user_id = Auth::user() ? Auth::user()->id : $request->user_id;
            $myModel->original_url = $request->original_url;
            $myModel->save();

            DB::commit();
            return $myModel;
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function details($slug)
    {
        if(Auth::user()){
            $data = Url::whereUserId(Auth::user()->id)->whereSlug($slug)->first();
        }else{
            $data = Url::whereSlug($slug)->first();
        }
        
        return $data;
    }

    public function destroy($slug)
    {
        if(Auth::user()){
            $data = Url::whereUserId(Auth::user()->id)->whereSlug($slug)->delete();
        }else{
            $data = Url::whereSlug($slug)->delete();
        }
        
        return true;
    }


    // Data Validation Before Save
    public function isErrorSave($request)
    {
        return [
            'user_id' => Auth::user() ? 'nullable' : 'required|exists:users,id',
            'original_url' => [
                'required',
                Rule::requiredIf(function () use ($request) {
                    return !empty($request->original_url);
                }),
                function ($attribute, $value, $fail) {
                    if (!filter_var($value, FILTER_VALIDATE_URL)) {
                        //$fail('The ' . str_replace('_', ' ', $attribute) . ' field must be a valid URL.');
                        $fail('The Url field must be a valid URL.');
                    }
                },
            ],
            'generated_url' => [
                'nullable',
                'max:8',
                Rule::unique('urls', 'generated_url')
                    ->ignore($request->slug, 'slug')
                    ->whereNull('deleted_at') // If you have soft deletes
            ],
        ];
    }

    public function customValidationMessage($request)
    {
        return [
            'user_id.required' => 'The user field is required.',
            'original_url.required' => 'The url field is required.',
        ];
    }

}
