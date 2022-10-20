@extends('layout.header')@section('content')
<style>
    /* Important part */
    .modal-dialog {
        overflow-y: initial !important
    }

    .modal-body {
        height: 80vh;
        overflow-y: auto;
    }
</style>
<div class="modal fade" id="warningModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="modal-content" method="get" id="delete">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Warning</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="height: auto !important;">
                <p>Are you sure you want to delete this Exam?</p>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                <button type="submit" class="btn btn-danger" id="delete">Delete</button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="add_students" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form class="modal-content" action="{{ route('exam_group_items.add_students') }}" method="post">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Students</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row pb10" id="exam_info2">

                </div>
                <div class="divider2"></div>

                <div class="form-group">
                    <select onchange="searchStudents(event,'tbody');" name="class_room" class="form-control">
                        <option value="">Select</option>
                        @foreach ($class_rooms as $class_room)
                            <option value="{{ $class_room->id }}">{{ $class_room->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="ln_solid"></div>
                <table class="table table-stripped table-hover">
                    <thead>
                        <th><input onchange="checkOrUncheckAll(this,'studentscheckbox');" type="checkbox"
                                class=" input-check" /></th>
                        <th>StudentID</th>
                        <th>Student Full Name</th>
                        <th>Gender</th>
                    </thead>

                    <tbody id="tbody">

                    </tbody>
                </table>
                <div class="form-group text-right">
                    <button id="submit" style="display: none;" type="submit"
                        class="btn btn-success btn-sm">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="newexammodal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" action="{{ route('exams.store') }}" method="post">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">New Exam</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" style="height: auto !important;">
                <div class="form-group">
                    <input type="text" name="name" placeholder="Exam Title/Name" id=""
                        class="form-control">
                    <input type="hidden" name="exam_group_id" value="{{ $examgroup->id }}">
                </div>
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="exams" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" action="{{ route('exam_groups.add_exam', $examgroup->id) }}" method="post">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">Add Exam</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-stripped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="check_all"
                                    onchange="checkOrUncheckAll(this,'choose_exams');">
                            </th>

                            <th>
                                Exam
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($exams as $exam)
                            <tr>
                                <td><input type="checkbox" name="exams[]" class="choose_exams"
                                        value="{{ $exam->id }}"> </td>
                                <td>{{ $exam->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="exam_marks" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Exam Subjects</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body subject-body">
                <div class="row pb10" id="exam_info3">

                </div>
                <div class="divider2"></div>


                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="">Subject</th>
                            <th class="">Date</th>
                            <th class="">Time</th>
                            <th class="">Duration</th>
                            <th class="">Credit Hours</th>
                            <th class="tddm150">Marks (Max..)</th>
                            <th class="tddm150">Marks (Min..)</th>
                            <th>Add marks</th>

                        </tr>
                    </thead>
                    <tbody id="subjects_list">

                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <div class="modal fade" id="add_marks" role="dialog" aria-hidden="true">

        <div class="modal-dialog modal-xl">


            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="subjectname"></h4>

                    <button type="button" class="close"
                        onclick="$('#add_marks').modal('hide');$('#tbody2').html('')"><span
                            aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div role="tabpanel" id="togglable-tabs">

                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#tab_content1" id="home-tab"
                                    role="tab" data-toggle="tab" aria-expanded="true">Results Form</a>
                            </li>
                            <li role="presentation" class=""><a href="#tab_content2" role="tab"
                                    id="profile-tab" data-toggle="tab" aria-expanded="false">Upload Results</a>
                            </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <form enctype="multipart/form-data" action="{{ route('exam_results.store_in_batch') }}"
                                method="post" role="tabpanel" class="tab-pane active " id="tab_content1"
                                aria-labelledby="home-tab">
                                @csrf
                                <input type="hidden" name="subject_id" id="subjectid">
                                <input type="hidden" name="exam_group_item_id" id="exam_item_id">
                                <div class="form-group">
                                    <select id="st" onchange="searchStudents(event,'tbody2',true);"
                                        name="class_room" class="form-control">
                                        <option value="">Select</option>
                                        @foreach ($class_rooms as $class_room)
                                            <option value="{{ $class_room->id }}">{{ $class_room->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="ln_solid"></div>
                                <table class="table table-stripped table-hover">
                                    <thead>
                                        <th><input onchange="checkOrUncheckAll(this,'studentscheckbox');"
                                                type="checkbox" class=" input-check" /></th>
                                        <th>StudentID</th>
                                        <th>Student Full Name</th>
                                        <th>Gender</th>
                                        <th>Attendance</th>
                                        <th>Marks</th>
                                        <th>Note</th>
                                    </thead>

                                    <tbody id="tbody2">

                                    </tbody>
                                </table>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Save</button>
                                </div>
                            </form>
                            <div role="tabpanel" class="tab-pane fade" id="tab_content2"
                                aria-labelledby="profile-tab">
                                <form action="{{ route('exam_results.export') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="exam" id="exam_item_id2">
                                    <input type="hidden" name="subject" id="subjectid2">
                                    <div class="form-group">
                                        <button type="submit" class="btn-success-inverse btn btn-success btn-block"><i
                                                class="fa fa-download"></i>
                                            Download Template</button>
                                    </div>
                                </form>
                                <br />
                                <form enctype="multipart/form-data" action="{{ route('exam_results.import') }}"
                                    method="post">
                                    @csrf
                                    <input type="file" name="file" class="dropify" data-height="300" />
                                    <br />
                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Save</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>




</div>
<div class="modal fade" id="subjectsmodal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form class="modal-content" action="{{ route('exam_group_items.add_subjects') }}" method="post">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Exam Subjects</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body subject-body">
                <div class="row pb10" id="exam_info">

                </div>
                <div class="divider2"></div>

                <div class="row">
                    <div class="col-md-12">
                        <button type="button" name="add" class="btn btn-success btn-sm add pull-right"
                            autocomplete="off"><span class="fa fa-plus"></span> Add Exam Subject</button>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="">Subject</th>
                            <th class="">Date</th>
                            <th class="">Time</th>
                            <th class="">Duration</th>
                            <th class="">Credit Hours</th>
                            <th class="tddm150">Marks (Max..)</th>
                            <th class="tddm150">Marks (Min..)</th>

                        </tr>
                    </thead>
                    <tbody id="item_table">

                    </tbody>
                </table>
                <div class="modal-footer">
                    <div class="row">
                        <button type="submit" class="btn btn-success pull-right">Save</button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Exam Group</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="nav navbar-right panel_toolbox">
                            <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#newexammodal"
                                href="#" id="examModalButton">
                                New Exam</a>
                            <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#exams"
                                href="#"> Link Exams</a>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content"><br />

                        <div class="row pb10">
                            <div class="col-lg-2 col-md-3 col-sm-12 col-xs-6">
                                <p class="examinfo"><b> Exam Group</b> <br /> {{ $examgroup->name }}</p>
                            </div>
                            <!--./col-lg-4-->
                            <div class="col-lg-2 col-md-3 col-sm-12 col-xs-6">
                                <p class="examinfo"><b> Exam Type</b> <br /> {{ $examgroup->exam_type->name }}</p>
                            </div>
                            <!--./col-lg-4-->
                            <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12">
                                <p class="examinfo"><b> Description </b> <br /> {{ $examgroup->description }} </p>
                            </div>
                            <!--./col-lg-4-->

                        </div>
                        @if (Session::has('success'))
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <div id="alert" class="alert alert-success text-white  alert-dismissible"
                                        role="alert">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong>{{ Session::get('success') }}</strong>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (Session::has('error'))
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <div id="alert" class="alert alert-danger text-white  alert-dismissible"
                                        role="alert">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong>{{ Session::get('error') }}</strong>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <table class="table table-hover table-striped table-bordered loading1" id="exam_table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Academic Year</th>
                                    <th>Subjects Included</th>
                                    <th>Students Included</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($examgroup->exam_group_items as $item)
                                    @if ($item->academic_year->id == $activeYear)
                                        <tr>
                                            <td>
                                                {{ $item->exam->name }} </td>
                                            <td>
                                                {{ $item->academic_year->year }} </td>


                                            <td class="text text-center">
                                                {{ $item->exam_subjects->count() }}
                                            </td>
                                            <td class="text text-center">
                                                {{ $item->exam_students->count() }}
                                            </td>

                                            <td class="text-right">

                                                <button type="button" data-toggle="tooltip"
                                                    title="Assign / View Student"
                                                    class="btn btn-default btn-xs assignStudent"
                                                    onclick="initExamItem('{{ $examgroup->name }}','{{ $item->exam->name }}','{{ $item->id }}',true,false,false);"><i
                                                        class="fa fa-tag"></i>
                                                </button>
                                                <button class="btn btn-default btn-xs" data-toggle="tooltip"
                                                    title="Exam Subjects"
                                                    onclick="initExamItem('{{ $examgroup->name }}','{{ $item->exam->name }}','{{ $item->id }}',false,true,false);initExamSubjects({{ $item->exam_subjects }})"><i
                                                        class="fa fa-book" aria-hidden="true"></i></button>
                                                <button type="button" class="btn btn-default btn-xs"
                                                    onclick="initExamItem('{{ $examgroup->name }}','{{ $item->exam->name }}','{{ $item->id }}',false,false,true);getExamSubjects({{ $item->exam_subjects }},'{{ $item->id }}');"
                                                    data-toggle="tooltip" title="Exam Marks"><i
                                                        class="fa fa-newspaper-o"></i></button>

                                                <span data-toggle="tooltip" title="Delete">
                                                    <a href="#"
                                                        class="btn btn-default btn-xs"data-toggle="modal"
                                                        data-target="#warningModal"
                                                        onclick="initDeleteExamItem({{ $item->id }})"><i
                                                            class="fa fa-remove"></i></a>
                                                </span>
                                            </td>
                                        </tr>
                                    @endif
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

<script>
    var subjects = `@json($subjects)`
    subjects = JSON.parse(subjects)


    function checkOrUncheckAll(target, boxclass) {
        if ($(target).is(':checked')) {
            $('.' + boxclass).each(function(i, obj) {
                obj.setAttribute('checked', true)
            });
        } else {
            $('.' + boxclass).each(function(i, obj) {
                obj.removeAttribute('checked')
            });
        }
    }

    function getExamSubjects(prev_subjects, itemid) {
        row = ``
        prev_subjects.forEach(subj => {
            subjects_option = ``
            subjects.forEach(s => {
                if (subj.subject_id == s.id) {
                    row +=
                        `<tr>
                    <td width="150">${s.name}</td>
                    <td><div class="input-group">${subj.date}</div></td>
                    <td><div class="input-group">${subj.time}</div></td>
                    <td>${subj.duration}</td>
                    <td>${subj.credit_hours}</td>
                    <td class="">${subj.max_marks}</td>
                    <td class="">${subj.min_marks}</td>
                    <td class="text-center" ><a onclick="initSubjectMarks('${s.name}',${subj.id},${itemid})" class="text-black" data-toggle="tooltip" title="Add marks" href="#"><i class="fa fa-calendar"></i></a></td>
                </tr>`
                }
            })

        });
        $("#subjects_list").html(row)
    }

    function initSubjectMarks(sjname, sjid, itemid) {
        $("#subjectname").html(sjname)
        $("#subjectid").val(sjid)
        $("#exam_item_id").val(itemid)
        $("#subjectid2").val(sjid)
        $("#exam_item_id2").val(itemid)
        $("#add_marks").modal('show')
    }

    function initExamSubjects(prev_subjects) {
        var row = ``;
        prev_subjects.forEach(subj => {
            subjects_option = ``
            subjects.forEach(s => {
                if (subj.subject_id == s.id) {
                    subjects_option += `
                    <option selected value = '${s.id}'>
                        ${s.name}(${s.code})
                    </option>
                    `
                } else {
                    subjects_option += `
                    <option  value='${s.id}'>
                        ${s.name}(${s.code})
                    </option>
                    `
                }
            })
            row +=
                `<tr>
                    <td width="150"><select name="subjects[]" class="form-control">${subjects_option}</select></td>
                    <td><div class="input-group"><input type="date" value="${subj.date}" name="date_${subj.subject_id}" class="form-control"/></div></td>
                    <td><div class="input-group"><input type="time" value="${subj.time}" name="time_${subj.subject_id}" class="form-control"/></div></td>
                    <td><input type="text" name="duration_${subj.subject_id}" value="${subj.duration}" class="form-control duration" value="0"/></td>
                    <td><input type="number" min="0" value="${subj.credit_hours}" name="credit_hours_${subj.subject_id}" class="form-control" value="0"/></td>
                    <td class=""><input type="number" value="${subj.max_marks}" min="0" name="max_marks_${subj.subject_id}" class="form-control" /></td>
                    <td class=""><input type="number" value="${subj.min_marks}" min="0" name="min_marks_${subj.subject_id}" class="form-control" /></td>
                    <td class="text-center" style="vertical-align: middle; cursor: pointer;"><span class="text text-danger remove fa fa-times mt5"></span></td>
                </tr>`
        });
        $('#item_table').html(row);

        initSelect2()

        $("#subjectsmodal").modal('show')
    }

    function searchStudents(event, holder, is_marks = false) {
        class_room = event.target.options[event.target.selectedIndex].value;
        if (class_room == '') return false;
        let tbody = document.getElementById(holder);
        let exam_group_item_id = $("#exam_group_item_id").val()
        tbody.innerHTML = ``
        $.ajax({
            type: "get",
            url: "/class_rooms/get_class_students/" + class_room,
            success: function(response) {
                students = response
                if (Object.keys(students).length < 1) {
                    $("#table_data").html(
                        "<tr><td rowspan='3'><h5 class='text-warning'><i class='fa fa-trash'></i> No students are in this class.</h5></td></tr>"
                    )
                    $("#submit").hide()
                    return false;
                }
                already_exists = false;
                students.forEach(student => {
                    // console.log(student)
                    let BreakException = {}
                    try {
                        student.exam_group_items.forEach(item => {
                            if (exam_group_item_id == item.id) {
                                already_exists = true;
                                throw BreakException
                            }
                        })
                    } catch (e) {
                        if (e !== BreakException) throw e;
                    }
                    tr = document.createElement('tr')
                    tr.id = student.id
                    if (is_marks) {
                        subject_found = false;
                        current_subject = $("#subjectid").val()
                        if (already_exists) {
                            student.exam_results.forEach(result => {
                                is_checked = result.is_absent ? 'checked' : ''
                                if (result.subject_id == current_subject) {
                                    tr.innerHTML = `<td><input type="checkbox" checked name="students[]" value="${student.id}" class="studentscheckbox input-check"/></td>
                                <td>${student.id}</td>
                                <td>${student.fullname}</td>
                                <td>${student.gender}</td>
                                <td><input type="checkbox" ${is_checked}  value="${student.id}" onclick="setMarksToZero(this,'marks_${student.id}')"  name="is_absent${student.id}" class="input-check"> <label class="input-label"> Absent</label></td>
                                <td><input type="text" id="marks_${student.id}" value="${result.marks}" name="marks_${student.id}" class="form-control"> </td>
                                <td><input type="text" name="note_${student.id}" value="${result.note}"  class="form-control"></td>
                                `
                                    subject_found = true;
                                }
                            })
                            if (!subject_found) {
                                tr.innerHTML = `<td><input type="checkbox" name="students[]" value="${student.id}" class="studentscheckbox input-check"/></td>
                                <td>${student.id}</td>
                                <td>${student.fullname}</td>
                                <td>${student.gender}</td>
                                <td><input type="checkbox" value="${student.id}" onclick="setMarksToZero(this,'marks_${student.id}')"  name="is_absent${student.id}" class="input-check"> <label class="input-label"> Absent</label></td>
                                <td><input type="text" id="marks_${student.id}" name="marks_${student.id}" class="form-control"> </td>
                                <td><input type="text" name="note_${student.id}" class="form-control"></td>
                                `
                            }

                        }
                    } else {
                        if (already_exists) {
                            tr.innerHTML = `
                                <td><input checked type="checkbox"  name="students[]" value="${student.id}" class="studentscheckbox input-check"/></td>
                                <td>${student.id}</td>
                                <td>${student.fullname}</td>
                                <td>${student.gender}</td>
                        `
                            already_exists = false;
                        } else {
                            tr.innerHTML = `
                                <td><input type="checkbox" name="students[]" value="${student.id}" class="studentscheckbox input-check"/></td>
                                <td>${student.id}</td>
                                <td>${student.fullname}</td>
                                <td>${student.gender}</td>
                        `
                        }

                    }

                    tbody.appendChild(tr)
                });

                $("#submit").show()

            },
        });
    }

    function initDeleteExamItem(id) {
        document.getElementById("delete").action = "/exam_group_items/" + id + "/delete";
    }

    function initExamItem(examgroupname, examname, groupitemid, is_students, is_subjects, is_marks) {

        if (is_students) {
            document.getElementById('exam_info2').innerHTML = `
                <div class="col-lg-2 col-md-3 col-sm-12">
                        <p class="examinfo"><strong>Exam</strong><br/>${examname}</p>
                        <input type="hidden" name="exam_group_item_id" id="exam_group_item_id" value="${groupitemid}"/>
                    </div>
                    <div class="col-lg-10 col-md-9 col-sm-12">
                        <p class="examinfo"><strong>Exam Group</strong><br/>${examgroupname}</p>
                    </div>`
            $("#add_students").modal('show')
        }
        if (is_subjects) {
            document.getElementById('exam_info').innerHTML = `
                <div class="col-lg-2 col-md-3 col-sm-12">
                        <p class="examinfo"><strong>Exam</strong><br/>${examname}</p>
                        <input type="hidden" name="exam_group_item_id" value="${groupitemid}"/>
                    </div>
                    <div class="col-lg-10 col-md-9 col-sm-12">
                        <p class="examinfo"><strong>Exam Group</strong><br/>${examgroupname}</p>
                    </div>
                `
        }
        if (is_marks) {
            document.getElementById('exam_info3').innerHTML = `
                <div class="col-lg-2 col-md-3 col-sm-12">
                        <p class="examinfo"><strong>Exam</strong><br/>${examname}</p>
                        <input type="hidden" name="exam_group_item_id" id="exam_group_item_id" value="${groupitemid}"/>
                    </div>
                    <div class="col-lg-10 col-md-9 col-sm-12">
                        <p class="examinfo"><strong>Exam Group</strong><br/>${examgroupname}</p>
                    </div>`
            $("#exam_marks").modal({
                backdrop: 'static',
                keyboard: false
            })
        }
    }

    function initSelect2() {
        $('select').each(function() {
            $(this).select2({
                width: '100%'
            })
        });
    }


    function setMarksToZero(target, marks_id) {
        if ($(target).is(':checked')) {
            $('#' + marks_id).val(0)
        } else {
            $('#' + marks_id).val('')
        }
    }


    function setupNames(target) {
        subject_id = target.options[target.selectedIndex].value;
        children = target.parentElement.parentElement.childNodes
        children[1].childNodes[0].childNodes[0].setAttribute('name', 'date_' + subject_id)
        children[2].childNodes[0].childNodes[0].setAttribute('name', 'time_' + subject_id)
        children[3].childNodes[0].childNodes[0].setAttribute('name', 'duration_' + subject_id)
        children[4].childNodes[0].childNodes[0].setAttribute('name', 'credit_hours_' + subject_id)
        children[5].childNodes[0].childNodes[0].setAttribute('name', 'max_marks_' + subject_id)
        children[6].childNodes[0].childNodes[0].setAttribute('name', 'min_marks_' + subject_id)
    }

    var subjects_option = `<option value=""></option>`

    subjects.forEach(b => {
        subjects_option += `
                    <option  value='${b.id}'>
                        ${b.name}(${b.code})
                    </option>
                    `
    })

    var x = 1;

    $(document).on('click', '.add', function() {
        var html = '';
        html += '<tr>';
        html += '<td width="150"><select onchange="setupNames(this)" name="subjects[]" class="form-control">' +
            subjects_option +
            '</select></td>';
        html +=
            '<td><div class="input-group"><input type="date"  class="form-control" required/></div></td>';
        html +=
            '<td><div class="input-group"><input type="time"  class="form-control" required/></div></td>';
        html +=
            '<td><div class="input-group"><input type="text"  class="form-control duration" value="0" required/></div></td>';
        html +=
            '<td><div class="input-group"><input type="number"  class="form-control" value="0" required/></div></td>';
        html +=
            '<td><div class="input-group"><input type="number" min="0"  class="form-control" required/></div></td>';
        html +=
            '<td><div class="input-group"><input type="number" min="0"  class="form-control" required/></div></td>';
        html +=
            '<td class="text-center" style="vertical-align: middle; cursor: pointer;"><span class="text text-danger remove fa fa-times mt5"></span></td></tr>';
        $('#item_table').append(html);
        x++;
        initSelect2();
    });

    $(document).on('click', '.remove', function() {
        $(this).closest('tr').remove();
    });
</script>
@endsection
