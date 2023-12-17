@extends('frontend.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Url List</h3>
                    </div><!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="more-options"><em class="icon ni ni-more-v"></em></a>
                            <div class="toggle-expand-content" data-content="more-options">
                                <ul class="nk-block-tools g-3">
                                    <li class="nk-block-tools-opt">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalDataForm"><em class="icon ni ni-plus"></em> Add New</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->

            <div class="card card-bordered card-preview px-3 py-4">
                <div class="nk-block overflow-hidden">
                    <table class="table table-striped tablle-responsive table-bordered data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                {{-- <th>User</th> --}}
                                <th>Original Url</th>
                                <th>Generated Url</th>
                                <th>Total Visited</th>
                                <th width="100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                {{-- <th>User</th> --}}
                                <th>Original Url</th>
                                <th>Generated Url</th>
                                <th>Total Visited</th>
                                <th width="100px">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- Modal Form -->
<div class="modal fade" id="modalDataForm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Save Url</h5>
                <a class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form id="dataForm" method="post" action="" enctype="multipart/form-data" autocomplete="off">
                    <input class="data_slug" type="hidden" name="slug">
                    <div class="form-group">
                        <label class="form-label">Url</label>
                        <div class="form-control-wrap">
                            <textarea class="form-control" required name="original_url" placeholder="Enter your url here..."></textarea>
                        </div>
                    </div>
                    <div class="form-group generated-url-wrap" style="display: none;">
                        <label class="form-label">Generated Url</label>
                        <div class="form-control-wrap">
                            <input type="text" maxlength="8" class="form-control" required name="generated_url">
                        </div>
                    </div>

                    <div class="form-group text-right">
                        <button class="data-save-btn btn btn-lg btn-primary" type="button" onclick="modalSave('{{route('user.url.save')}}')">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop


@push('scripts')
    <script type="text/javascript">
      $(function () {
          
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('user.url.index') }}",
            order: [ [0, 'desc'] ],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                //{data: 'id', name: 'id'},
                //{data: 'user_id', name: 'user_id'},
                {data: 'original_url', name: 'original_url'},
                {data: 'generated_url', name: 'generated_url'},
                {data: 'visit_count', name: 'visit_count'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
          
      });
    </script>
    @include('._commonPartials.custom-scripts')
@endpush