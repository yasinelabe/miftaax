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
                                    <button type="submit" class="btn btn-success form-control"><i class="fa fa-search"></i>
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
                                <a class="nav-link" id="tuesday-tab" data-toggle="tab" href="#tuesday"
                                    role="tab" aria-controls="tuesday" aria-selected="false">Tuesday</a>
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

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="saturday" role="tabpanel"
                                aria-labelledby="saturday-tab">
                                <br />
                                <br />
                            </div>
                            <div class="tab-pane fade show active" id="sunday" role="tabpanel"
                                aria-labelledby="sunday-tab">
                                <br />
                                <br />
                            </div>
                            <div class="tab-pane fade show active" id="monday" role="tabpanel"
                                aria-labelledby="monday-tab">
                                <br />
                                <br />
                            </div>
                            <div class="tab-pane fade show active" id="tuesday" role="tabpanel"
                                aria-labelledby="tuesday-tab">
                                <br />
                                <br />
                            </div>
                            <div class="tab-pane fade show active" id="wednesday" role="tabpanel"
                                aria-labelledby="wednesday-tab">
                                <br />
                                <br />
                            </div>
                            <div class="tab-pane fade show active" id="thrustday" role="tabpanel"
                                aria-labelledby="thrustday-tab">
                                <br />
                                <br />
                            </div>
                            <div class="tab-pane fade show active" id="friday" role="tabpanel"
                                aria-labelledby="friday-tab">
                                <br />
                                <br />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
