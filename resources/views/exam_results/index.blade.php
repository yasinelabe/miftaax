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

                            {{-- <div class="col-3">
                                <form enctype="multipart/form-data" action="{{ route('exam_results.import') }}"
                                    method="post" class="input-group mb-3">
                                    @csrf
                                    <input class="form-control" type="file" name="file">
                                    <div class="input-group-append">
                                        <input type="submit" value="Import" class="btn btn-success">
                                    </div>
                                </form>
                            </div> --}}
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

                        <form class="row" action="{{ route('exam_results.index') }}" method="post">
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
                                    <label>Class</label><small class="req"> *</small>
                                    <select id="class_room_id" name="class_room_id" class="form-control" required>
                                        <option value="">Select</option>
                                        @foreach ($class_rooms as $class_room)
                                            <option value="{{ $class_room->id }}">{{ $class_room->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger"></span>
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
                                @if (!empty($theads))
                                    <table class="table table-bordered table-stripped table-hover" id="results_table">
                                        <thead>

                                            <tr>
                                                @foreach ($theads as $th)
                                                    <th>{{ $th[1] }}</th>
                                                @endforeach
                                            </tr>


                                        </thead>
                                        @php
                                            end($theads);
                                            $result_index = (int) key($theads);
                                            $percent_index = $result_index - 1;
                                            $total_index = $result_index - 2;
                                        @endphp
                                        <tbody>

                                            @foreach ($students as $student)
                                                @if ($student != null)
                                                    @php
                                                        $total_marks = 0;
                                                    @endphp

                                                    @foreach ($student->exam_results as $result)
                                                        @php
                                                            $total_marks += $result->marks;
                                                        @endphp
                                                    @endforeach

                                                    <tr>
                                                        @foreach ($theads as $th)
                                                            @if ($th[0] == 0)
                                                                <td>{{ $student->id }}</td>
                                                            @endif
                                                            @if ($th[0] == 1)
                                                                <td>{{ $student->fullname }}</td>
                                                            @endif
                                                            @php
                                                                $results = [];
                                                            @endphp
                                                            @foreach ($student->exam_results as $result)
                                                                @php
                                                                    array_push($results, $result->exam_subject->id);
                                                                @endphp
                                                            @endforeach

                                                            @if (!in_array($th[0], $results) && $th[0] != 1 && $th[0] != 0)
                                                                @if ($th[0] == $total_index)
                                                                    @if ($type == 'GPA')
                                                                        <td>
                                                                            @php
                                                                                echo '( ' . App\Models\Grading::find(App\Models\Grading::get_grading_id(number_format((float) $total_marks, 2, '.', ''), $max_limit))->grade . ' )';
                                                                            @endphp
                                                                        </td>
                                                                    @else
                                                                        <td> {{ number_format((float) $total_marks, 2, '.', '') . '/' . number_format((float) $max_limit, 2, '.', '') }}
                                                                        </td>
                                                                    @endif
                                                                @else
                                                                    @if ($type == 'GPA')
                                                                    @else
                                                                        @if ($th[0] == $result_index)
                                                                            <td>
                                                                                @php
                                                                                    echo '( ' . App\Models\Grading::find(App\Models\Grading::get_grading_id(number_format((float) $total_marks, 2, '.', ''), $max_limit))->grade . ' )';
                                                                                @endphp
                                                                            </td>
                                                                        @else
                                                                            @if ($th[0] == $percent_index)
                                                                                <td>{{ number_format(((float) $total_marks * 100) / $max_limit, 2, '.', '') . '%' }}
                                                                                </td>
                                                                            @else
                                                                                <td></td>
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @else
                                                                @foreach ($student->exam_results as $result)
                                                                    @if ($result->exam_subject->id == $th[0])
                                                                        <td>{{ $result->marks . ' (' . $result->grading->grade . ')' }}
                                                                            <br /><small>{{ $result->note }}</small>
                                                                        </td>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach

                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>

                                    </table>
                                @endif
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
            if ($("#results_table")) {
                $("#results_table").DataTable({
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
