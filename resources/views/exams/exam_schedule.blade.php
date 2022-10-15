@extends('layout.header') @section('content')

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
            </div>
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
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

                    <div class="x_title">

                        <div class="row">
                            <div class="col-2">
                                <h2>Search Criteria</h2>
                            </div>

                        </div>

                    </div>
                    <div class="x_content">
                        @if (Session::has('success'))
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="alert" class="alert alert-success text-white  alert-dismissible"
                                        role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                        <strong>{{ Session::get('success') }}</strong>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <form class="row" action="{{ route('exams.schedule') }}" method="post">
                            @csrf
                            <div class="col-sm-6 col-lg-3 col-md-3">
                                <div class="form-group">
                                    <label>Exam Group</label><small class="req"> *</small>
                                    <select onchange="initExams(this)" id="exam_group_id" class="form-control" required>
                                        <option value="">Select</option>
                                        @foreach ($exam_groups as $exam_group)
                                            <option value="{{ $exam_group->id }}">{{ $exam_group->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--./col-md-3-->
                            <div class="col-sm-6 col-lg-3 col-md-3">
                                <div class="form-group">
                                    <label>Exam</label><small class="req"> *</small>
                                    <select id="exam_group_item_id" name="exam_group_item_id" class="form-control" required>
                                        <option value="">Select</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label>...</label>
                                    <button type="submit" class="btn btn-success form-control"><i class="fa fa-search"></i>
                                        Search</button>
                                </div>
                            </div>

                        </form>

                        <br />
                        <br />
                        <div class="divider"></div>

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-stripped table-hover" id="schedule_table">
                                    <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Date</th>
                                            <th>Start time</th>
                                            <th>Duration</th>
                                            <th>Marks (Max)</th>
                                            <th>Marks (Min)</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if ($examgrouptitem)
                                            @foreach ($examgrouptitem->exam_subjects as $examsubject)
                                                <tr>
                                                    <td>{{ $examsubject->subject->name }}</td>
                                                    <td>{{ $examsubject->date }}</td>
                                                    <td>{{ $examsubject->time }}</td>
                                                    <td>{{ $examsubject->duration }}</td>
                                                    <td>{{ $examsubject->max_marks }}</td>
                                                    <td>{{ $examsubject->min_marks }}</td>
                                                </tr>
                                            @endforeach
                                        @endif


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
        function initExams(target) {
            let exam_group = target.options[target.options.selectedIndex].value;
            let exams = JSON.parse(`@json($exam_group_items)`)
            let exam_options = `<option value="">Select</option>`
            exams.forEach(exam => {
                if (exam.exam_group_id == exam_group) {
                    exam_options += `<option value="${exam.id}">${exam.exam.name}</option>`
                }
            });
            $("#exam_group_item_id").html(exam_options)

        }

        $(document).ready(function() {
            if ($("#schedule_table")) {
                $("#schedule_table").DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5'
                    ],
                    paging: false,
                    ordering: true,
                    info: false,
                })
            }

        })
    </script>
@endsection
