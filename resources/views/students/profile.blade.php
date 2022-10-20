@extends('layout.header') @section('content')
    <!-- page content -->
    <div class="right_col" role="main">

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">

                            <div class="row">
                                <div class="col-2">
                                    <h2>Student profile</h2>
                                </div>
                            </div>

                        </div>
                        <div class="x_content">

                            <div class="col-sm-3">

                                <div class="card">
                                    <div class="card-body">

                                        <div class="profile_img text-center w-100">
                                            <div id="crop-avatar">
                                                <!-- Current avatar -->
                                                <img class="img-responsive avatar-view"
                                                    src="/images/nophoto-{{ $student->gender }}.png" alt="Avatar"
                                                    title="Change the avatar">
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                        <ul class="list-group user_data">
                                            <li class="list-group-item">Name: {{ $student->fullname }}</li>
                                            <li class="list-group-item">Address:
                                                {{ $student->student_address->area }}
                                            </li>
                                            <li class="list-group-item">Gender:
                                                {{ $student->gender }}
                                            </li>

                                            <li class="list-group-item">
                                                DOB: {{ $student->date_of_birth }}
                                            </li>

                                            <li class="list-group-item">
                                                Joined: {{ $student->joined_date }}
                                            </li>

                                            <li class="list-group-item">
                                                Blood G: {{ $student->blood_group->name }}
                                            </li>
                                            <li class="list-group-item">
                                                Fee: {{ $student->fee_amount }}
                                            </li>
                                            <li class="list-group-item">
                                                Balance: {{ $student->fee_balance }}
                                            </li>

                                            <li class="list-group-item">
                                                Graduated: {{ $student->is_graduated == 1 ? 'Yes' : 'No' }}
                                            </li>
                                            <li class="list-group-item">
                                                Active: {{ $student->is_active == 1 ? 'Yes' : 'No' }}
                                            </li>
                                            <li class="list-group-item">Class Rooms: @foreach ($student->class_rooms as $class_room)
                                                    {{ $class_room->name }},
                                                @endforeach
                                            </li>

                                        </ul>
                                    </div>
                                </div>



                            </div>
                            <div class="col-md-9 col-sm-9 ">

                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
                                            role="tab" aria-controls="home" aria-selected="true">Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile"
                                            role="tab" aria-controls="profile" aria-selected="false">Fees</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact"
                                            role="tab" aria-controls="contact" aria-selected="false">Exam results</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel"
                                        aria-labelledby="home-tab">
                                        <div class="tshadow mb25 bozero">
                                            <h3 class="pagetitleh2">Parent / Guardian Details </h3>
                                            <div class="table-responsive around10 pt10">
                                                <table class="table table-hover table-striped tmb0">
                                                    <tbody>
                                                        <tr>
                                                            <td>Guardian Name</td>
                                                            <td>{{ $student->guardian->fullname }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Guardian Phone</td>
                                                            <td>{{ $student->guardian->tell }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Family Link</td>
                                                            <td>{{ $student->guardian->family_link }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tshadow mb25 bozero">
                                            <h3 class="pagetitleh2">Siblings </h3>
                                            <div class="table-responsive around10 pt10">
                                                @if ($student->guardian->children->count() == 1)
                                                    <p>No siblings are registered</p>
                                                @endif
                                                @foreach ($student->guardian->children as $child)
                                                    @if ($child->id != $student->id)
                                                        <table class="table table-hover table-striped tmb0">
                                                            <tbody>
                                                                <tr>
                                                                    <td>Name: {{ $student->fullname }}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Address:{{ $student->student_address->area }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Gender:{{ $student->gender }}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>DOB: {{ $student->date_of_birth }}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Joined: {{ $student->joined_date }}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Blood G: {{ $student->blood_group->name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Fee: {{ $student->fee_amount }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td> Balance: {{ $student->fee_balance }}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Graduated:
                                                                        {{ $student->is_graduated == 1 ? 'Yes' : 'No' }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Active:
                                                                        {{ $student->is_active == 1 ? 'Yes' : 'No' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Class Rooms: @foreach ($child->class_rooms as $class_room)
                                                                            {{ $class_room->name }},
                                                                        @endforeach
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <table class="table table-bordered table-striped no-margin">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Fee</th>
                                                    <th>Academic Year</th>
                                                    <th>Type</th>
                                                    <th>Amount</th>
                                                    <th>Balance</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($student->fee_transactions as $k => $row)
                                                    <tr>
                                                        <td>{{ $row->id }}</td>
                                                        <td>{{ $row->fee->name }}</td>
                                                        <td>{{ $row->fee->academic_year->year }}</td>
                                                        <td>
                                                            @if ($row->transaction_type == 'payment')
                                                                <span class="badge badge-success">
                                                                    {{ $row->transaction_type }}
                                                                </span>
                                                            @else
                                                                <span class="badge badge-danger">
                                                                    {{ $row->transaction_type }}
                                                                </span>
                                                            @endif
                                                        </td>

                                                        <td>{{ $row->amount }}</td>
                                                        <td>
                                                            <span class="badge badge-default">
                                                                {{ $row->fee_balance }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            @if ($row->fee_balance > 0 && $row->transaction_type == 'payment')
                                                                <span class="badge badge-warning">
                                                                    Partial
                                                                </span>
                                                            @endif
                                                            @if ($row->fee_balance == 0 && $row->transaction_type == 'payment')
                                                                <span class="badge badge-success">
                                                                    Paid
                                                                </span>
                                                            @endif
                                                            @if ($row->transaction_type == 'invoice' && $k == $student->fee_transactions->count() - 1)
                                                                <span class="badge badge-danger">
                                                                    Unpaid
                                                                </span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $row->transaction_date }}</td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                        @foreach ($student->exam_group_items as $exam)
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>{{ $exam->exam->name }}</th>
                                                        <th>{{ $exam->academic_year->year }}</th>
                                                        <th></th>
                                                    </tr>
                                                    <tr>
                                                        <th>Subject</th>
                                                        <th>Marks</th>
                                                        <th>Grade</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach ($student->exam_results as $result)
                                                        <tr>
                                                            <td>{{ $result->exam_subject->subject->name }}</td>
                                                            <td>{{ number_format((float) $result->marks, 2, '.', '') }}</td>
                                                            <td>@php
                                                                echo App\Models\Grading::find(App\Models\Grading::get_grading_id(number_format((float) $result->marks, 2, '.', ''), $result->exam_subject->max_marks))->grade;
                                                            @endphp</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table><br />
                                        @endforeach
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
