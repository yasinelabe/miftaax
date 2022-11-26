@extends('layout.header')@section('content')
<div class="customModal hidden" onclick="toggleModal()">

</div>
<div class="customBox hidden">
    <div class="customBoxHeader">
        <div class="row">
            <div class="col-5">
                <select name="class_room" id="selectedClassRoom" class="form-control">
                    <option value=""></option>
                    @foreach ($class_rooms as $class)
                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-4">
                <input type="text" id="studentNameOrId" placeholder="Search Student ID/NAME"
                    class="form-control rounded">
            </div>
            <div class="col-2">
                <button onclick="getStudents()" class="btn btn-success"><i class="fa fa-search"> Search</i></button>
            </div>
        </div>
    </div>
    <div class="customBoxBody">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>Student ID</th>
                    <th>Full Name</th>
                    <th>Fee Balance</th>
                </tr>
            </thead>

            <tbody class="tableTbody" id="studentTable">

            </tbody>
        </table>
    </div>
    <div class="customBoxFooter">
        <div class="row">
            <div class="col-8"></div>
            <div class="col-4">
                <button onclick="saveSelection()" class="btn btn-success">
                    Save Selection
                </button>
            </div>
        </div>
    </div>
</div>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Fee</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content"><br />
                        <form enctype="multipart/form-data" data-parsley-validate
                            class="form-horizontal form-label-left" method="POST" action="{{ route('fees.store') }}">
                            @csrf

                            <div class="row">

                                <div class="col-sm-3"><select onchange="handleFeeType(this)" class="form-control"
                                        name="fee_type_id">
                                        <option value="">Select Fee type </option>
                                        @foreach ($fee_type_ids as $fee_type_id)
                                            <option value="{{ $fee_type_id->id }}">{{ $fee_type_id->name }}</option>
                                        @endforeach
                                    </select></div>

                                <div id="months" class="hidden col-sm-3">
                                    <select name="month" class="form-control ">
                                        <option value="">Month</option>
                                        <option value="Jan">Jan</option>
                                        <option value="Feb">Feb</option>
                                        <option value="Mar">Mar</option>
                                        <option value="Apr">Apr</option>
                                        <option value="May">May</option>
                                        <option value="Jun">Jun</option>
                                        <option value="Jul">Jul</option>
                                        <option value="Aug">Aug</option>
                                        <option value="Sep">Sep</option>
                                        <option value="Oct">Oct</option>
                                        <option value="Nov">Nov</option>
                                        <option value="Dec">Dec</option>
                                    </select>

                                </div>

                                <div id="amounts" class="hidden col-sm-3"><input placeholder="Amount" type="number" id="amount"
                                        name="amount" class="form-control "></div>

                            </div>

                            <hr>
                            <div class="row">
                                <div id="choices" class="col-sm-3">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <input onchange="handleChoices(this)" checked value="1"
                                                        type="radio" name="choices"> All Students
                                                </th>
                                                <th>
                                                    <input onchange="handleChoices(this)" type="radio" value="2"
                                                        name="choices"> Choose Students
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>


                            <div class="row hidden" id="students">

                                <div class="col-sm-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <a title="Add students" onclick="toggleModal()" href="#"
                                                        class="btn btn-sm btn-success">
                                                        <i class="fa fa-plus"></i>
                                                    </a>
                                                    <a title="Reset list" onclick="resetList()" href="#"
                                                        class="btn btn-sm btn-danger">
                                                        <i class="fa fa-eraser"></i>
                                                    </a>
                                                </th>

                                                <th>StudentID</th>
                                                <th>
                                                    Full Name
                                                </th>
                                                <th>Unpaid Balance</th>
                                            </tr>
                                        </thead>

                                        <tbody id="selectedStudents">

                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="ln_solid"></div>
                            <div class="row">
                                <div class="col-3"><button type="submit" class="btn btn-sm btn-success"><i
                                            class="fa fa-save"></i> Save</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    function handleFeeType(target) {

        let value = target.options[target.options.selectedIndex].value

        switch (value) {
            case '1':
                document.getElementById('months').classList.remove('hidden')
                document.getElementById('amounts').classList.add('hidden')
                break;

            default:
                document.getElementById('amounts').classList.remove('hidden')
                document.getElementById('months').classList.add('hidden')
                break;
        }
    }


    function handleChoices(target) {
        let value = target.value

        switch (value) {
            case '1':
                document.getElementById('students').classList.add('hidden')
                break;

            default:
                document.getElementById('students').classList.remove('hidden')
                break;
        }
    }


    function toggleModal() {
        document.querySelector('.customModal').classList.toggle('hidden')
        document.querySelector('.customBox').classList.toggle('hidden')
        document.getElementById('studentTable').innerHTML = ``
    }

    function resetList() {
        $("#selectedStudents").html(``)
    }


    function getStudents() {
        let ClassRooms = document.getElementById('selectedClassRoom')
        let selectedClassRoom = ClassRooms.options[ClassRooms.options.selectedIndex].value
        let studentNameOrId = document.getElementById('studentNameOrId').value
        let tbody = document.getElementById('studentTable')
        tbody.innerHTML = ``

        if (selectedClassRoom != '') {
            $.ajax({
                type: "get",
                url: "/class_rooms/get_class_students/" + selectedClassRoom,
                success: function(response) {
                    students = response
                    output = false;
                    if (Object.keys(students).length < 1) {
                        return false;
                    }
                    students.forEach(student => {
                        tr = document.createElement('tr')
                        tr.id = student.id
                        tr.innerHTML = `
                        <td><input value="${student.id}" type="checkbox" class="check_student"></td>
                        <td>${student.id}</td>
                        <td>${student.fullname}</td>
                        <td>${student.fee_balance}</td>
                        `
                        tbody.appendChild(tr);
                    });
                },
            });

            return false;
        }

        if (studentNameOrId != '') {
            $.ajax({
                type: "get",
                url: "/students/search_students/" + studentNameOrId,
                success: function(response) {
                    students = response
                    output = false;
                    if (Object.keys(students).length < 1) {
                        return false;
                    }
                    students.forEach(student => {
                        tr = document.createElement('tr')
                        tr.id = student.id
                        tr.innerHTML = `
                        <td><input value="${student.id}" name="students[]" type="checkbox" class="check_student"></td>
                        <td>${student.id}</td>
                        <td>${student.fullname}</td>
                        <td>${student.fee_balance}</td>
                        `
                        tbody.appendChild(tr);
                    });
                },
            });
        }
    }


    function saveSelection() {
        $('.check_student').each(function(i, item) {
            if(item.checked == true){
                let v = item.value
            $("#selectedStudents").append($("#" + v))
            }
        })
        toggleModal()
    }


    $(function() {
        $('#select-all').click(function(event) {
            var selected = this.checked;
            // Iterate each checkbox
            $('.check_student').each(function() {
                this.checked = selected;
            });

        });
    });
</script>
@endsection
