@extends('layouts.master')
@section('title')
    Customers

@stop
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
                <h4 class="content-title mb-0 my-auto">General</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Customers</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">

        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



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











    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <a class="btn btn-outline-primary btn-block" href="{{ route('customer.create') }}"> Add
                        Customer </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>

                                <tr>
                                    <th>#</th>
                                    <th> Operations </th>
                                    <th>Customer Name </th>
                                    <th>Customer Abb </th>
                                    <th>Customer type </th>
                                    <th> Logo </th>
                                    <th> Customer Contact name </th>
                                    <th> Customer contact position </th>
                                    <th>Email </th>
                                    <th>Phone</th>

                                </tr>

                            </thead>

                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($custs as $cust)
                                    <?php $i++; ?>

                                    <td>{{ $i }}</td>
                                    <td>
                                        {{-- @can(' ') --}}
                                        <a class=" btn btn-sm btn-info" data-effect="effect-scale"
                                            data-id="{{ $cust->id }}"data-name="{{ $cust->name }}"
                                            data-abb="{{ $cust->abb }}"data-tybe="{{ $cust->tybe }}"
                                            data-logo="{{ $cust->logo }}"
                                            data-customercontactname="{{ $cust->customercontactname }}"
                                            data-customercontactposition="{{ $cust->customercontactposition }}"
                                            data-email="{{ $cust->email }}" data-phone="{{ $cust->phone }}"
                                            data-toggle="modal" href="#exampleModal2" title="Upadte"><i
                                                class="las la-pen"></i></a>
                                        {{-- @endcan --}}

                                        {{-- @can(' ') --}}
                                        <a class=" btn btn-sm btn-danger" data-effect="effect-scale"
                                            data-id="{{ $cust->id }}" data-name="{{ $cust->name }}"
                                            data-toggle="modal" href="#modaldemo9" title="Delete"><i
                                                class="las la-trash"></i></a>
                                        {{-- @endcan --}}
                                        {{-- <td> --}}
                                        {{-- <a href="{{ route('customer.edit'.$id) }}" class="btn btn-sm btn-info" title="Upadte"><i
                                                    class="las la-pen"></i></a>
                                            <a href=" route('customer.delete'.$id) " class="btn btn-sm btn-danger" title="Delete"><i
                                                    class="las la-trash"></i></a>
                                        </td> --}}
                                    </td>
                                    <td>{{ $cust->name }}</td>
                                    <td>{{ $cust->abb }}</td>
                                    <td>{{ $cust->tybe }}</td>
                                    {{-- <td>{{ $cust->custs_attachments->logo }}</td> --}}
                                    {{-- <td>{{ $cust->logo }}</td> --}}
                                    <td> <img src="{{ asset('storage/'.$cust->logo) }}" alt="" height="50"> </td>
                                    <td>{{ $cust->customercontactname }}</td>
                                    <td>{{ $cust->customercontactposition }}</td>
                                    <td>{{ $cust->email }}</td>
                                    <td>{{ $cust->phone }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




    {{-- <div class="modal" id="modaldemo8">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title"> Add Customer </h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('customer.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="abb">Abb</label>
                            <input type="text" class="form-control" id="abb" name="abb">
                        </div>

                        <div class="form-group">
                            <label for="tybe">Type</label>
                            <select class="form-control" id="tybe" name="tybe" required>
                                <option value="">Select Value</option>
                                <option value="GOV">GOV</option>
                                <option value="PRIVATE">PRIVATE</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="logo">Logo</label>
                            <input type="file" class="form-control" id="logo" name="logo">
                        </div>

                        <div class="form-group">
                            <label for="customercontactname">Customer Contact Name</label>
                            <input type="text" class="form-control" id="customercontactname"
                                name="customercontactname">
                        </div>

                        <div class="form-group">
                            <label for="customercontactposition">Customer Contact Position</label>
                            <input type="text" class="form-control" id="customercontactposition"
                                name="customercontactposition">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>


                        <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-primary">Add</button>
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Basic modal -->




        <!-- /row -->
    </div> --}}


    <!-- edit -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="customer/update" method="POST" autocomplete="off">
                        @csrf
                        {{ method_field('PUT') }}


                        <div class="form-group">
                            <input type="hidden" name="id" id="id" value="">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="abb">Abb</label>
                            <input type="text" class="form-control" id="abb" name="abb">
                        </div>

                        <div class="form-group">
                            <label for="tybe">Type</label>
                            <select class="form-control" id="tybe" name="tybe" required>
                                <option value="">Select Value</option>
                                <option value="GOV">GOV</option>
                                <option value="PRIVATE">PRIVATE</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="logo">Logo</label>
                            <input type="file" class="form-control" id="logo" name="logo">
                        </div>

                        <div class="form-group">
                            <label for="customercontactname">Customer Contact Name</label>
                            <input type="text" class="form-control" id="customercontactname"
                                name="customercontactname">
                        </div>

                        <div class="form-group">
                            <label for="customercontactposition">Customer Contact Position</label>
                            <input type="text" class="form-control" id="customercontactposition"
                                name="customercontactposition">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-primary">Confirm</button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- delete -->
    <div class="modal" id="modaldemo9">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Delete</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>

                <form action="customer/destroy" method="post">
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
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>



    <script>
        $('#exampleModal2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            var abb = button.data('abb');
            var tybe = button.data('tybe');
            var logo = button.data('logo');
            var customercontactname = button.data('customercontactname');
            var customercontactposition = button.data('customercontactposition');
            var email = button.data('email');
            var phone = button.data('phone');
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #abb').val(abb);
            modal.find('.modal-body #tybe').val(tybe);
            modal.find('.modal-body #logo').val(logo);
            modal.find('.modal-body #customercontactname').val(customercontactname);
            modal.find('.modal-body #customercontactposition').val(customercontactposition);
            modal.find('.modal-body #email').val(email);
            modal.find('.modal-body #phone').val(phone);
            modal.find('.modal-body #abb').val(abb);

        })
    </script>

    <script>
        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id');
            var name = button.data('name');
            var abb = button.data('abb');
            var tybe = button.data('tybe');
            var logo = button.data('logo');
            var customercontactname = button.data('customercontactname');
            var customercontactposition = button.data('customercontactposition');
            var email = button.data('email');
            var phone = button.data('phone');
            var modal = $(this);
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #abb').val(abb);
            modal.find('.modal-body #tybe').val(tybe);
            modal.find('.modal-body #logo').val(logo);
            modal.find('.modal-body #customercontactname').val(customercontactname);
            modal.find('.modal-body #customercontactposition').val(customercontactposition);
            modal.find('.modal-body #email').val(email);
            modal.find('.modal-body #phone').val(phone);
            modal.find('.modal-body #abb').val(abb);

        })
    </script>
@endsection
