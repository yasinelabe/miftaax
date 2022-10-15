@extends('layout.header') @section('content')
    <style>
        .modal-lg,
        .modal-xl {
            max-width: 70%;
            margin-left: 15%;
        }

        .model-content {
            height: 70vh !important;
        }
    </style>
    <div class="modal fade edit_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Edit ClassRoom</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe id="iframe" title="description"></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade students_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Add students</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="modal-body" method="post" action="{{ route('class_rooms.import_students') }}">
                    @csrf

                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <select onchange="getClassRooms(this);" name="academic_year" id="academic_years"
                                    class="form-control">
                                    <option value="">--Previous Year--</option>
                                    @foreach ($academic_years as $academicyear)
                                        @if ($academicyear->is_active == 0)
                                            <option value="{{ $academicyear->id }}">{{ $academicyear->year }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <input type="hidden" id="hidden_class_room" name="class_room">
                            <select id="class_rooms" class="form-control">
                                <option value="">Select</option>
                            </select>
                        </div>

                        <div class="col-sm-2">
                            <div class="input-group-append">
                                <a href="#" onclick="getStudents(event);" class="btn btn-success"><i
                                        class="fa fa-search"></i>
                                    Search</a>
                            </div>
                        </div>
                    </div>





                    <table class="table table-bordered" id="students_list">
                        <thead>
                            <th>
                                <input onchange="checkOrUnCheckAll()" type="checkbox" id="check_all" name="input-check">
                            </th>
                            <th>
                                ID
                            </th>
                            <th>
                                FULLNAME
                            </th>
                        </thead>
                        <tbody id="table_data">

                        </tbody>
                    </table>
                    <br />
                    <div class="row">
                        <div class="col-sm-6">
                            <button class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- warning modal before delete --}}
    <div class="modal fade" id="warningModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="modal-content" method="get" id="delete">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Warning</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this ClassRoom?</p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-danger" id="delete">Delete</button>
                </div>
            </form>
        </div>
    </div>

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
            </div>
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><a href="/class_rooms/create" class="btn btn-sm btn-success"><i
                                    class="fa fa-plus text-white"></i> ClassRoom</a></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if (Session::has('success'))
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="alert" class="alert alert-success text-white  alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>{{ Session::get('success') }}</strong>
                        </div>
                                </div>
                            </div>
                        @endif

                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="row">
                                    <div class="col-md-12">
                                        <p id="alert" class="alert alert-danger">
                                            {{ $error }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable-buttons"
                                        class="table jambo_table  table-striped  table-bordered dataTable no-footer dtr-inline"
                                        style="width: 100%;" role="grid" aria-describedby="datatable-buttons_info">
                                        <thead>
                                            <tr role="row">
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Academic year </th>
                                                <th>Shift </th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($class_rooms as $classroom)
                                                <tr role="row" class="odd">
                                                    <td>{{ $classroom->id }}</td>
                                                    <td>{{ $classroom->name }}</td>
                                                    <td>{{ $classroom->academic_year->year }}</td>
                                                    <td>{{ $classroom->shift->name }}</td>
                                                    <td><a href="#" data-toggle="modal" data-target=".edit_modal"
                                                            onclick="initializeIframe('{{ route('class_rooms.edit', $classroom->id) }}')"><i
                                                                class="fa fa-pencil"></i> Edit </a> | <a
                                                            href="javascript:void(0)" data-toggle="modal"
                                                            data-target="#warningModal"
                                                            onclick="delete_id({{ $classroom->id }})"><i
                                                                class="fa fa-trash-o"></i> Delete </a> |
                                                        <a href="javascript:void(0)" data-toggle="modal"
                                                            data-target=".students_modal"
                                                            onclick="setClassRoom({{ $classroom->id }})"><i
                                                                class="fa fa-plus"></i> Promote to students </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function delete_id(id) {
            document.getElementById("delete").action = "/class_rooms/" + id + "/delete";
        }

        function initializeIframe(url) {
            var iframe = document.getElementById("iframe");
            iframe.src = url;
        }


        function getClassRooms(target) {
            year = target.options[target.options.selectedIndex].value;
            $.ajax({
                type: "get",
                url: "/academic_years/get_year_classes/" + year,
                success: function(response) {
                    classes = response
                    output = `<option value="">Select</option>`

                    classes.forEach(cls => {
                        output += `
                            <option value="${cls.id}"> ${cls.name} </option>
                        `
                    });

                    $("#class_rooms").html(output)

                },
            });

        }


        function getStudents(event) {
            event.preventDefault();
            target = document.getElementById('class_rooms')
            class_room = target.options[target.options.selectedIndex].value;
            let table = $('#students_list').DataTable();
            $.ajax({
                type: "get",
                url: "/class_rooms/get_class_students/" + class_room,
                success: function(response) {
                    students = response
                    output = false;
                    if (Object.keys(students).length < 1) {
                        $("#table_data").html(
                            "<tr><td><h5 class='text-danger'><i class='fa fa-trash'></i> NO students were found.</h5></td></tr>"
                        )
                        return false;
                    }
                    students.forEach(student => {
                        output = true;
                        tr = document.createElement('tr')
                        tr.id = student.id
                        tr.innerHTML = `
                            <tr id="student${student.id}">
                                <td><input type="checkbox" name="students[]" class="input-check choose_students" value="${student.id}"/></td>
                                <td>${student.id}</td>
                                <td>${student.fullname}</td>
                            </tr>
                        `
                        table.row.add(tr).draw();
                    });

                    if (!output) {
                        $("#table_data").html(
                            "<tr><td><h5 class='text-danger'><i class='fa fa-trash'></i> NO students were found.</h5></td></tr>"
                        )
                        return false;
                    }

                },
            });
        }

        function checkOrUnCheckAll() {
            if ($('#check_all').is(':checked')) {
                $('.choose_students').each(function(i, obj) {
                    obj.setAttribute('checked', true)
                });
            } else {
                $('.choose_students').each(function(i, obj) {
                    obj.removeAttribute('checked')
                });
            }


        }

        function setClassRoom(value) {
            document.getElementById('hidden_class_room').value = value
        }
    </script>
@endsection
