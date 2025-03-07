@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('title')
    Add Project
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Add Project</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Projects</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- row -->
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

    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form id="yourFormId" action="{{ route('project.store') }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        @csrf
                        {{-- 1 --}}

                        <div class="row">
                            <div class="col">
                                <label for="pr_number" class="control-label">PR Number </label>
                                <input type="number" class="form-control" id="pr_number" name="pr_number"
                                    title="    Please enter the project number  ">
                            </div>
                            <div class="col">
                                <label for="name" class="control-label">PR Name </label>
                                <input type="text" class="form-control" id="name" name="name"
                                    title="   Please enter the project name  ">
                            </div>
                            <div class="col">
                                <label for="technologies" class="control-label">Technologies </label>
                                <input type="text" class="form-control" id="technologies" name="technologies"
                                    title="   Please enter the project technologies  ">
                            </div>




                            <div class="col">
                                <label for="vendors" class="control-label"> Vendorsr </label>
                                <select name="vendors_id" class="form-control SlectBox" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')">
                                    <!--placeholder-->
                                    <option value="" selected disabled> Vendors </option>
                                    @foreach ($vendors as $vendor)
                                        <option value="{{ $vendor->id }}"> {{ $vendor->vendors }}</option>
                                    @endforeach
                                </select>
                            </div>


                            {{-- <div class="col">
                                <label>تاريخ الفاتورة</label>
                                <input class="form-control fc-datepicker" name="invoice_Date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ date('Y-m-d') }}" required>
                            </div>

                            <div class="col">
                                <label>تاريخ الاستحقاق</label>
                                <input class="form-control fc-datepicker" name="Due_date" placeholder="YYYY-MM-DD"
                                    type="text" required>
                            </div> --}}
                        </div>



                        <div class="row mt-3">

                            <div class="col">
                                <label for="ds" class="control-label">Suppliers</label>
                                <select name="ds_id" class="form-control SlectBox" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')">
                                    <!--placeholder-->
                                    <option value="" selected disabled> Suppliers </option>
                                    @foreach ($ds as $dss)
                                        <option value="{{ $dss->id }}"> {{ $dss->dsname }}</option>
                                    @endforeach
                                </select>
                            </div>



                            <div class="col">
                                <label for="name" class="control-label">Customer Name</label>
                                <select name="cust_id" class="form-control SlectBox" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')">
                                    <!--placeholder-->
                                    <option value="" selected disabled> Customer Name </option>
                                    @foreach ($custs as $cust)
                                        <option value="{{ $cust->id }}"> {{ $cust->name }}</option>
                                    @endforeach
                                </select>
                            </div>



                            <div class="col">
                                <label for="customer_po" class="control-label">Customer PO# </label>
                                <input type="text" class="form-control" id="customer_po" name="customer_po"
                                    title="   Please enter the  customer po  ">
                            </div>
                            <div class="col">
                                <label for="value" class="control-label">Value </label>
                                <input type="number" class="form-control" id="value" name="value"
                                    title="   Please enter the project value  ">
                            </div>

                        </div>






                        <div class="row mt-3">



                            <div class="col">
                                <label for="name" class="control-label">AC Manager </label>
                                <select name="name" class="form-control SlectBox" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')">
                                    <!--placeholder-->
                                    <option value="" selected disabled> AC Manager </option>
                                    @foreach ($aams as $aam)
                                        <option value="{{ $aam->id }}"> {{ $aam->name }}</option>
                                    @endforeach
                                </select>
                            </div>



                            <div class="col">
                                <label for="name" class="control-label"> Project Manager </label>
                                <select name="name" class="form-control SlectBox" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')">
                                    <!--placeholder-->
                                    <option value="" selected disabled> Project Manager </option>
                                    @foreach ($ppms as $ppm)
                                        <option value="{{ $ppm->id }}"> {{ $ppm->name }}</option>
                                    @endforeach
                                </select>
                            </div>






                            <div class="col">
                                <label for="customer_contact_details" class="control-label">Customer contact details
                                </label>
                                <input type="text" class="form-control" id="customer_contact_details"
                                    name="customer_contact_details" title="   Please enter the  customer po  ">
                            </div>

                        </div>




                        <div class="row mt-4">
                            <div class="col">
                                <div style="text-align:justify;">
                                    <div style="display: inline-flex;">
                                        <h5 class="card-title mr-3">PO attachment</h5>
                                        <p class="text-danger">* Attachment format pdf, jpeg, .jpg, png </p>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-12">
                                    <input type="file" name="pic" class="dropify"
                                        accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />
                                </div><br>

                            </div>

                            <div class="col">

                                <div style="text-align:justify;">
                                    <div style="display: inline-flex;">
                                        <h5 class="card-title mr-3 ">EPO attachment</h5>
                                        <p class="text-danger">* Attachment format pdf, jpeg, .jpg, png </p>
                                    </div>
                                </div>


                                <div class="col-sm-12 col-md-12">
                                    <input type="file" name="pic" class="dropify"
                                        accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />
                                </div><br>

                            </div>








                        </div>



                        <div class="row">


                            {{-- <div class="col">
                                <label for="customer_po_date" class="control-label  fc-datepicker ">Customer PO date
                                </label>
                                <input type="date" class="form-control" id="customer_po_date" name="customer_po_date"
                                    title="   Please enter the  Customer PO date" value="{{ date('Y-m-d') }}">
                            </div> --}}

                            <div class="col">
                                <label>Customer PO date </label>
                                <input class="form-control fc-datepicker"id="customer_po_date" name="customer_po_date"
                                    placeholder="YYYY-MM-DD" type="text" value="{{ date('Y-m-d') }}" required>
                            </div>



                            <div class="col">
                                <label for="customer_po_duration" class="control-label">Customer PO duration </label>
                                <input type="number" class="form-control" id="customer_po_duration"
                                    name="customer_po_duration" title="   Please enter the  Customer PO duration ">
                            </div>



                            <div class="col">
                                <label for="customer_po_duration" class="control-label fc-datepicker">Customer PO
                                    deadline </label>
                                <input type="text" class="form-control" id="customer_po_deadline"
                                    name="customer_po_deadline" title="   Please enter the  Customer PO deadline"
                                    value="{{ date('Y-m-d') }}">
                            </div>

                        </div>






                        <div class="row">
                            <div class="col mt-3">
                                <label for="description">Nots</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>
                        </div><br>



















                        {{-- 2 --}}
                        {{-- <div class="row">








                            <div class="col">
                                <label for="inputName" class="control-label">القسم</label>
                                <select name="Section" class="form-control SlectBox" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')">
                                    <!--placeholder-->
                                    <option value="" selected disabled>حدد القسم</option> --}}
                        {{-- @foreach ($sections as $section)
                                        <option value="{{ $section->id }}"> {{ $section->section_name }}</option>
                                    @endforeach --}}
                        {{-- </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">المنتج</label>
                                <select id="product" name="product" class="form-control">
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">مبلغ التحصيل</label>
                                <input type="text" class="form-control" id="inputName" name="Amount_collection"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>

                        </div> --}}


                        {{-- 3 --}}

                        {{-- <div class="row">

                            <div class="col">
                                <label for="inputName" class="control-label">مبلغ العمولة</label>
                                <input type="text" class="form-control form-control-lg" id="Amount_Commission"
                                    name="Amount_Commission" title="يرجي ادخال مبلغ العمولة "
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    required>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">الخصم</label>
                                <input type="text" class="form-control form-control-lg" id="Discount"
                                    name="Discount" title="يرجي ادخال مبلغ الخصم "
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value=0 required>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">نسبة ضريبة القيمة المضافة</label>
                                <select name="Rate_VAT" id="Rate_VAT" class="form-control" onchange="myFunction()">
                                    <!--placeholder-->
                                    <option value="" selected disabled>حدد نسبة الضريبة</option>
                                    <option value=" 5%">5%</option>
                                    <option value="10%">10%</option>
                                </select>
                            </div>

                        </div>

                        {{-- 4 --}}

                        {{-- <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">قيمة ضريبة القيمة المضافة</label>
                                <input type="text" class="form-control" id="Value_VAT" name="Value_VAT" readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">الاجمالي شامل الضريبة</label>
                                <input type="text" class="form-control" id="Total" name="Total" readonly>
                            </div>
                        </div> --}}

                        {{-- 5 --}}
                        {{-- <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">ملاحظات</label>
                                <textarea class="form-control" id="exampleTextarea" name="note" rows="3"></textarea>
                            </div>
                        </div><br> --}}





                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary"> Save Project </button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>

    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'mm/dd/yy'
        }).val();
    </script>
    {{-- ds  --}}
    <script>
        $(document).ready(function() {
            $('select[name="ds_id"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('ds_id') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="product"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="product"]').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });
                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });

        });
    </script>
    {{-- /ds  --}}


    {{-- vendor  --}}
    <script>
        $(document).ready(function() {
            $('select[name="vendors_id"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('vendors_id') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="product"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="product"]').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });

                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });

        });
    </script>
    {{-- /vendor  --}}







    {{-- cust  --}}
    <script>
        $(document).ready(function() {
            $('select[name="cust_id"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('cust_id') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="product"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="product"]').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });
                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });

        });
    </script>
    {{-- /cust  --}}






    {{-- cust  --}}
    <script>
        $(document).ready(function() {
            $('select[name="aams_id"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('aams_id') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="product"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="product"]').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });
                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });

        });
    </script>
    {{-- /cust  --}}


    {{-- cust  --}}
    <script>
        $(document).ready(function() {
            $('select[name="ppms_id"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('ppms_id') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="product"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="product"]').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });
                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });

        });
    </script>
    {{-- /cust  --}}














    {{-- <script>
        function myFunction() {

            var Amount_Commission = parseFloat(document.getElementById("Amount_Commission").value);
            var Discount = parseFloat(document.getElementById("Discount").value);
            var Rate_VAT = parseFloat(document.getElementById("Rate_VAT").value);
            var Value_VAT = parseFloat(document.getElementById("Value_VAT").value);

            var Amount_Commission2 = Amount_Commission - Discount;


            if (typeof Amount_Commission === 'undefined' || !Amount_Commission) {

                alert('يرجي ادخال مبلغ العمولة ');

            } else {
                var intResults = Amount_Commission2 * Rate_VAT / 100;

                var intResults2 = parseFloat(intResults + Amount_Commission2);

                sumq = parseFloat(intResults).toFixed(2);

                sumt = parseFloat(intResults2).toFixed(2);

                document.getElementById("Value_VAT").value = sumq;

                document.getElementById("Total").value = sumt;

            }

        }
    </script> --}}


    {{-- <script>
        document.getElementById('customer_po_duration').addEventListener('input', () => {
            const startDate = document.getElementById('customer_po_date').value;
            const daysToAdd = parseInt(document.getElementById('customer_po_duration').value, 10);

            if (startDate && !isNaN(daysToAdd)) {
                const date = new Date(startDate);
                date.setDate(date.getDate() + daysToAdd); // إضافة الأيام

                const resultDate = date.toISOString().split('T')[0]; // تنسيق التاريخ (YYYY-MM-DD)
                document.getElementById('customer_po_deadline').value = resultDate; // عرض التاريخ الناتج
            }
        });
    </script> --}}


    {{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        flatpickr("#customer_po_date", {
            dateFormat: "Y-m-d" // الصيغة المطلوبة (YYYY-MM-DD)
        });
    });
</script> --}}

    {{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        // تفعيل Flatpickr للحقل الأساسي
        const baseDatePicker = flatpickr("#customer_po_date", {
            dateFormat: "Y-m-d", // الصيغة المطلوبة
            onChange: updateModifiedDate // تحديث التاريخ المعدل عند تغيير التاريخ الأساسي
        });

        // تحديد الحقول
        const daysInput = document.getElementById('customer_po_duration'); // حقل عدد الأيام
        const resultDateInput = document.getElementById('customer_po_deadline'); // الحقل الذي يعرض التاريخ المعدل

        // إضافة حدث لتحديث التاريخ المعدل عند تغيير عدد الأيام
        daysInput.addEventListener('input', updateModifiedDate);

        // دالة لحساب التاريخ المعدل
        function updateModifiedDate() {
            const baseDateValue = baseDatePicker.selectedDates[0]; // الحصول على التاريخ الأساسي
            const daysToAdd = parseInt(daysInput.value, 10) || 0; // الحصول على عدد الأيام (افتراضي صفر)

            if (baseDateValue) {
                // إضافة الأيام إلى التاريخ الأساسي
                const modifiedDate = new Date(baseDateValue);
                modifiedDate.setDate(modifiedDate.getDate() + daysToAdd+1);

                // تحديث الحقل الثالث
                resultDateInput.value = modifiedDate.toISOString().split('T')[0]; // صيغة Y-m-d
            } else {
                resultDateInput.value = "#customer_po_date"; // إذا لم يتم تحديد تاريخ، اترك الحقل فارغًا
            }
        }
    });
</script> --}}

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            // تفعيل Flatpickr للحقل الأساسي
            const baseDatePicker = flatpickr("#customer_po_date", {
                dateFormat: "Y-m-d", // الصيغة المطلوبة
                onChange: updateModifiedDate // تحديث التاريخ المعدل عند تغيير التاريخ الأساسي
            });

            // تحديد الحقول
            const daysInput = document.getElementById('customer_po_duration'); // حقل عدد الأيام
            const resultDateInput = document.getElementById(
            'customer_po_deadline'); // الحقل الذي يعرض التاريخ المعدل

            // إضافة حدث لتحديث التاريخ المعدل عند تغيير عدد الأيام
            daysInput.addEventListener('input', updateModifiedDate);

            // دالة لحساب التاريخ المعدل
            function updateModifiedDate() {
                const baseDateValue = baseDatePicker.selectedDates[0]; // الحصول على التاريخ الأساسي
                let daysToAdd = parseInt(daysInput.value, 10); // تحويل القيمة إلى رقم

                if (isNaN(daysToAdd)) {
                    daysToAdd = 0; // إذا لم تكن القيمة رقمًا، يتم تعيين صفر
                }

                if (baseDateValue) {
                    // إضافة الأيام إلى التاريخ الأساسي
                    const modifiedDate = new Date(baseDateValue);
                    modifiedDate.setDate(modifiedDate.getDate() + daysToAdd + 1);

                    // تحديث الحقل الثالث
                    resultDateInput.value = modifiedDate.toISOString().split('T')[0]; // صيغة Y-m-d
                } else {
                    resultDateInput.value = ""; // إذا لم يتم تحديد تاريخ، اترك الحقل فارغًا
                }
            }

            // التأكد من أن القيم تُرسل بشكل صحيح عند إرسال النموذج
            document.getElementById('yourFormId').addEventListener('submit', function(e) {
                // إذا لم يتم إدخال قيمة في الحقل، اجعلها صفرًا
                if (!daysInput.value) {
                    daysInput.value = 0;
                }
            });
        });
    </script> --}}

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();
    </script>
@endsection
