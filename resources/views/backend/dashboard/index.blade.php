@extends('backend.layouts.master')
@section('content')
<!-- Content Header (Page header) -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="col-md-8 m-auto">
                    <div class="card py-4 px-5">
                        <style type="text/css">
                            .initial-form .btn-sm{
                                height: calc(2.125rem + 2px);
                                border-top-left-radius:0;
                                border-bottom-left-radius:0;
                            }
                            .initial-form .form-control{
                                border-top-right-radius:0;
                                border-bottom-right-radius:0;
                            }
                        </style>
                        <form id="dataForm" class="initial-form" method="post" action="" enctype="multipart/form-data" autocomplete="off">
                            <input class="data_slug" type="hidden" name="slug">
                            <div class="form-group">
                                <label class="form-label">Url</label>
                                <div class="form-control-wrap">
                                    <div class="d-flex align-items-center">
                                        <input type="text" class="form-control" autofocus required name="original_url" placeholder="Enter your url here...">
                                        <button class="data-save-btn btn btn-sm btn-primary" type="button" onclick="modalSave('{{route('user.url.save')}}', 'resetFalse')">Generate</button>
                                    </div>
                                </div>
                            </div>


                            <div class="prev-generated-url-wrap mt-5" style="display: none;">
                                <label class="form-label">Generated New Url</label>
                                <div class="form-control-wrap d-flex align-items-center">
                                    <input readonly type="text" class="generated-url form-control" required>
                                    <a title="Copy Generated Url" class="copy-data-text-btn btn btn-info btn-sm" data-text=""><em class="text-light icon ni ni-copy"></em></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->
@endsection


@push('scripts')
    @include('._commonPartials.custom-scripts')
@endpush