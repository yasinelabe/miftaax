@extends('layout.header')@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Schedule</h3>
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

                        <form class="row" action="{{ route('schedules.create') }}" method="post">
                            @csrf
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
                                    <label>Subject Group</label><small class="req"> *</small>
                                    <select id="subject_group_id" name="subject_group_id" class="form-control" required>
                                        <option value="">Select</option>
                                        @foreach ($subject_groups as $subject_group)
                                            <option value="{{ $subject_group->id }}">{{ $subject_group->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3 col-md-12">
                                <div class="form-group">
                                    <label>...</label>
                                    <button type="submit" class="btn btn-success form-control"><i
                                            class="fa fa-search"></i>
                                        Search</button>
                                </div>
                            </div>

                        </form>

                        <br />
                        <br />
                        <div class="divider"></div>

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="saturday-tab" data-toggle="tab" href="#saturday"
                                    role="tab" aria-controls="saturday" aria-selected="true">Saturday</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="sunday-tab" data-toggle="tab" href="#sunday" role="tab"
                                    aria-controls="sunday" aria-selected="false">Sunday</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="monday-tab" data-toggle="tab" href="#monday" role="tab"
                                    aria-controls="monday" aria-selected="false">Monday</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tuesday-tab" data-toggle="tab" href="#tuesday" role="tab"
                                    aria-controls="tuesday" aria-selected="false">Tuesday</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="wednesday-tab" data-toggle="tab" href="#wednesday"
                                    role="tab" aria-controls="wednesday" aria-selected="false">Wednesday</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="thrustday-tab" data-toggle="tab" href="#thrustday"
                                    role="tab" aria-controls="thrustday" aria-selected="false">Thrustday</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="friday-tab" data-toggle="tab" href="#friday" role="tab"
                                    aria-controls="friday" aria-selected="false">Friday</a>
                            </li>
                        </ul>

                        <form action="{{ route('schedules.store') }}" method="post" class="tab-content"
                            id="myTabContent">
                            @csrf
                            <div class="tab-pane fade show active" id="saturday" role="tabpanel"
                                aria-labelledby="saturday-tab">
                                <br />
                                <br />


                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Teacher</th>
                                            <th>Time from</th>
                                            <th>Time to</th>
                                            <th></th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        @foreach ($class_room_subjects as $class_room_subject)
                                            <input type="hidden" name="class_room_id"
                                                value="{{ $class_room_subject->class_room_id }}">
                                            @foreach ($class_room_subject->subject_group->items as $subject_group_item)
                                                <tr>
                                                    <td>{{ $subject_group_item->subject->name }}
                                                        <input type="hidden" name="saturday_subjects[]"
                                                            value="{{ $subject_group_item->subject_id }}">
                                                    </td>
                                                    <td>
                                                        <select name="saturday_teacher_ids[]" required
                                                            class="form-control">
                                                            @foreach ($subject_group_item->subject->teachers as $teacher)
                                                                <option value="{{ $teacher->id }}">
                                                                    {{ $teacher->fullname }}</option>
                                                            @endforeach
                                                        </select>

                                                    </td>
                                                    <td>
                                                        <input type="time" class="form-control"
                                                            name="saturday_time_ins[]" required>
                                                    </td>
                                                    <td>
                                                        <input type="time" name="saturday_time_outs[]" required
                                                            class="form-control">
                                                    </td>
                                                    <td>
                                                        <span class="btn btn-danger btn-sm  remove fa fa-trash"></span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="sunday" role="tabpane2" aria-labelledby="sunday-tab">
                                <br />
                                <br />

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Teacher</th>
                                            <th>Time from</th>
                                            <th>Time to</th>
                                            <th></th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        @foreach ($class_room_subjects as $class_room_subject)
                                            @foreach ($class_room_subject->subject_group->items as $subject_group_item)
                                                <tr>
                                                    <td>{{ $subject_group_item->subject->name }}
                                                        <input type="hidden" name="sunday_subjects[]"
                                                            value="{{ $subject_group_item->subject_id }}">
                                                    </td>
                                                    <td>
                                                        <select name="sunday_teacher_ids[]" required
                                                            class="form-control">
                                                            @foreach ($subject_group_item->subject->teachers as $teacher)
                                                                <option value="{{ $teacher->id }}">
                                                                    {{ $teacher->fullname }}</option>
                                                            @endforeach
                                                        </select>

                                                    </td>
                                                    <td>
                                                        <input type="time" class="form-control"
                                                            name="sunday_time_ins[]" required>
                                                    </td>
                                                    <td>
                                                        <input type="time" name="sunday_time_outs[]" required
                                                            class="form-control">
                                                    </td>
                                                    <td>
                                                        <span class="btn btn-danger btn-sm  remove fa fa-trash"></span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <div class="tab-pane" id="monday" role="tabpane3" aria-labelledby="monday-tab">
                                <br />
                                <br />
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Teacher</th>
                                            <th>Time from</th>
                                            <th>Time to</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($class_room_subjects as $class_room_subject)
                                            @foreach ($class_room_subject->subject_group->items as $subject_group_item)
                                                <tr>
                                                    <td>{{ $subject_group_item->subject->name }}
                                                        <input type="hidden" name="monday_subjects[]"
                                                            value="{{ $subject_group_item->subject_id }}">
                                                    </td>
                                                    <td>
                                                        <select name="monday_teacher_ids[]" required
                                                            class="form-control">
                                                            @foreach ($subject_group_item->subject->teachers as $teacher)
                                                                <option value="{{ $teacher->id }}">
                                                                    {{ $teacher->fullname }}</option>
                                                            @endforeach
                                                        </select>

                                                    </td>
                                                    <td>
                                                        <input type="time" class="form-control"
                                                            name="monday_time_ins[]" required>
                                                    </td>
                                                    <td>
                                                        <input type="time" name="monday_time_outs[]" required
                                                            class="form-control">
                                                    </td>
                                                    <td>
                                                        <span class="btn btn-danger btn-sm  remove fa fa-trash"></span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="tuesday" role="tabpane4" aria-labelledby="tuesday-tab">
                                <br />
                                <br />
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Teacher</th>
                                            <th>Time from</th>
                                            <th>Time to</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($class_room_subjects as $class_room_subject)
                                            @foreach ($class_room_subject->subject_group->items as $subject_group_item)
                                                <tr>
                                                    <td>{{ $subject_group_item->subject->name }}
                                                        <input type="hidden" name="tuesday_subjects[]"
                                                            value="{{ $subject_group_item->subject_id }}">
                                                    </td>
                                                    <td>
                                                        <select name="tuesday_teacher_ids[]" required
                                                            class="form-control">
                                                            @foreach ($subject_group_item->subject->teachers as $teacher)
                                                                <option value="{{ $teacher->id }}">
                                                                    {{ $teacher->fullname }}</option>
                                                            @endforeach
                                                        </select>

                                                    </td>
                                                    <td>
                                                        <input type="time" class="form-control"
                                                            name="tuesday_time_ins[]" required>
                                                    </td>
                                                    <td>
                                                        <input type="time" name="tuesday_time_outs[]" required
                                                            class="form-control">
                                                    </td>
                                                    <td>
                                                        <span class="btn btn-danger btn-sm  remove fa fa-trash"></span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="wednesday" role="tabpane5" aria-labelledby="wednesday-tab">
                                <br />
                                <br />
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Teacher</th>
                                            <th>Time from</th>
                                            <th>Time to</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($class_room_subjects as $class_room_subject)
                                            @foreach ($class_room_subject->subject_group->items as $subject_group_item)
                                                <tr>
                                                    <td>{{ $subject_group_item->subject->name }}
                                                        <input type="hidden" name="wednesday_subjects[]"
                                                            value="{{ $subject_group_item->subject_id }}">
                                                    </td>
                                                    <td>
                                                        <select name="wednesday_teacher_ids[]" required
                                                            class="form-control">
                                                            @foreach ($subject_group_item->subject->teachers as $teacher)
                                                                <option value="{{ $teacher->id }}">
                                                                    {{ $teacher->fullname }}</option>
                                                            @endforeach
                                                        </select>

                                                    </td>
                                                    <td>
                                                        <input type="time" class="form-control"
                                                            name="wednesday_time_ins[]" required>
                                                    </td>
                                                    <td>
                                                        <input type="time" name="wednesday_time_outs[]" required
                                                            class="form-control">
                                                    </td>
                                                    <td>
                                                        <span class="btn btn-danger btn-sm  remove fa fa-trash"></span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="thrustday" role="tabpane6" aria-labelledby="thrustday-tab">
                                <br />
                                <br />
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Teacher</th>
                                            <th>Time from</th>
                                            <th>Time to</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($class_room_subjects as $class_room_subject)
                                            @foreach ($class_room_subject->subject_group->items as $subject_group_item)
                                                <tr>
                                                    <td>{{ $subject_group_item->subject->name }}
                                                        <input type="hidden" name="thrustday_subjects[]"
                                                            value="{{ $subject_group_item->subject_id }}">
                                                    </td>
                                                    <td>
                                                        <select name="thrustday_teacher_ids[]" required
                                                            class="form-control">
                                                            @foreach ($subject_group_item->subject->teachers as $teacher)
                                                                <option value="{{ $teacher->id }}">
                                                                    {{ $teacher->fullname }}</option>
                                                            @endforeach
                                                        </select>

                                                    </td>
                                                    <td>
                                                        <input type="time" class="form-control"
                                                            name="thrustday_time_ins[]" required>
                                                    </td>
                                                    <td>
                                                        <input type="time" name="thrustday_time_outs[]" required
                                                            class="form-control">
                                                    </td>
                                                    <td>
                                                        <span class="btn btn-danger btn-sm  remove fa fa-trash"></span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="friday" role="tabpane7" aria-labelledby="friday-tab">
                                <br />
                                <br />
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Teacher</th>
                                            <th>Time from</th>
                                            <th>Time to</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($class_room_subjects as $class_room_subject)
                                            @foreach ($class_room_subject->subject_group->items as $subject_group_item)
                                                <tr>
                                                    <td>{{ $subject_group_item->subject->name }}
                                                        <input type="hidden" name="friday_subjects[]"
                                                            value="{{ $subject_group_item->subject_id }}">
                                                    </td>
                                                    <td>
                                                        <select name="friday_teacher_ids[]" required
                                                            class="form-control">
                                                            @foreach ($subject_group_item->subject->teachers as $teacher)
                                                                <option value="{{ $teacher->id }}">
                                                                    {{ $teacher->fullname }}</option>
                                                            @endforeach
                                                        </select>

                                                    </td>
                                                    <td>
                                                        <input type="time" class="form-control"
                                                            name="friday_time_ins[]" required>
                                                    </td>
                                                    <td>
                                                        <input type="time" name="friday_time_outs[]" required
                                                            class="form-control">
                                                    </td>
                                                    <td>
                                                        <span class="btn btn-danger btn-sm  remove fa fa-trash"></span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="text-right">
                                <button class="btn-sm btn btn-success"><i class="fa fa-save"></i> Save</button>

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
    $(document).on('click', '.remove', function() {
        $(this).closest('tr').remove();
    });
</script>
@endsection
