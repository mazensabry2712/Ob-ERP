@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">General </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Projects</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">


        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')

    <!-- row opened -->
    @foreach (['Error', 'Add', 'delete', 'edit'] as $msg)
    @if (session()->has($msg))
        <div class="alert alert-{{ $msg == 'Error' || $msg == 'delete' ? 'danger' : 'success' }} alert-dismissible fade show"
            role="alert">
            <strong>{{ session()->get($msg) }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
@endforeach

    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                        href="{{ route('project.create') }}"> Add project </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Operations</th>
                                    <th class="border-bottom-0">#PR</th>
                                    <th class="border-bottom-0">Project Name</th>
                                    <th class="border-bottom-0">Technologies</th>
                                    <th class="border-bottom-0">Vendors</th>
                                    <th class="border-bottom-0">Suppliers</th>
                                    <th class="border-bottom-0">customer name</th>
                                    <th class="border-bottom-0">Customer PO#</th>
                                    <th class="border-bottom-0">value</th>
                                    <th class="border-bottom-0">AC Manager</th>
                                    <th class="border-bottom-0">Project Manager</th>
                                    <th class="border-bottom-0">Customer contact details</th>
                                    <th class="border-bottom-0">PO attachment</th>
                                    <th class="border-bottom-0">EPO Attachment</th>
                                    <th class="border-bottom-0">Customer PO date</th>
                                    <th class="border-bottom-0">Customer PO duration</th>
                                    <th class="border-bottom-0">Customer PO deadline</th>
                                    <th class="border-bottom-0">Notes</th>
                                </tr>
                                </tr>
                            </thead>
                        
                            <tbody>
                                <?php $i=0; ?> 
                                @foreach ($projects as $project)
                                <?php $i++; ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>
                                            <a href="{{ route('project.edit', $project->id) }}" class=" btn btn-sm btn-info"><i
                                                    class="las la-pen"></i></a>


                                            <a class=" btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-id="{{ $project->id }}" data-name="{{ $project->name }}"
                                                data-toggle="modal" href="#modaldemo9" title="Delete"><i
                                                    class="las la-trash"></i></a>
                                        </td>
                                        <td>{{ $project->pr_number }}</td>
                                        <td>{{ $project->name }}</td>
                                        <td>{{ $project->technologies }}</td>
                                        {{-- <td><a
                                                href="{{ url('Projects') }}/{{ $project->id }}">{{ $project->vendor->vendors }}</a>
                                        </td> --}}
                                        <td>{{ $project->vendors_id }}</td>
                                        <td>{{ $project->ds_id }}</td>
                                        <td>{{ $project->cust_id }}</td>
                                        <td>{{ $project->customer_po }}</td>
                                        <td>{{ $project->value }}</td>
                                        <td>{{ $project->aams_id }}</td>
                                        <td>{{ $project->ppms_id }}</td>
                                        <td>{{ $project->customer_contact_details }}</td>
                                        {{-- <td>{{ $project->po_attachment }}</td>   --}}
                                        {{-- <td>{{ $project->epo_attachment }}</td>   --}}
                                        
                                        {{-- <td>{{ $project->po_attachment }}</td> --}}
                                        <td> <img src="asset('storage/'.$project->po_attachment)" alt="" height="50"> </td>
                                        {{-- <td>{{ $project->epo_attachment }}</td> --}}
                                        <td> <img src="asset('storage/'.$project->epo_attachment)" alt="" height="50"> </td>

                                        <td>{{ $project->customer_po_date }}</td>
                                        <td>{{ $project->customer_po_duration }}</td>
                                        <td>{{ $project->customer_po_deadline }}</td>
                                        <td>{{ $project->description }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->

    </div>
    <!-- /row -->
    </div>
    <!-- delete -->
    <div class="modal" id="modaldemo9">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Delete</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>

                <form action="project/destroy" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <p> Are you sure about the deletion process?</p><br>
                        <input type="hidden" name="id" id="id" value="">
                        <input class="form-control" name="name" id="name" type="text" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Confirm</button>
                    </div>
            </div>
            </form>

        </div>
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection


@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <script>
        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')

            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);

        })
    </script>
@endsection
