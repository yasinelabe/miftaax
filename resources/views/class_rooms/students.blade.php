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

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable-buttons"
                                        class="table jambo_table  table-striped  table-bordered dataTable no-footer dtr-inline"
                                        style="width: 100%;" role="grid" aria-describedby="datatable-buttons_info">
                                        <thead>
                                            <tr role="row">
                                                <th>Id</th>
                                                <th>Fullname</th>
                                                <th>Gender</th>
                                                <th>Guardian </th>
                                                <th>Date of birth</th>
                                                <th>Joined date</th>
                                                <th>Address</th>
                                                <th>Has medical emergency</th>
                                                <th>Is active</th>
                                                <th>Is graduated</th>
                                                <th>Fee amount</th>
                                                <th>Fee balance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($students as $student)
                                                <tr role="row" class="odd">
                                                    <td>{{ $student->id }}</td>
                                                    <td><a
                                                            href="{{ route('students.profile', $student->id) }}">{{ $student->fullname }}</a>
                                                    </td>
                                                    <td>{{ $student->gender }}</td>
                                                    <td>{{ $student->guardian->fullname }}</td>
                                                    <td>{{ $student->date_of_birth }}</td>
                                                    <td>{{ $student->joined_date }}</td>
                                                    <td>{{ $student->student_address->area }}</td>
                                                    @if ($student->has_medical_emergency == 1)
                                                        <td>Yes</td>
                                                    @else
                                                        <td>No</td>
                                                    @endif

                                                    @if ($student->is_active == 1)
                                                        <td>Yes</td>
                                                    @else
                                                        <td>No</td>
                                                    @endif

                                                    @if ($student->is_graduated == 1)
                                                        <td>Yes</td>
                                                    @else
                                                        <td>No</td>
                                                    @endif
                                                    <td>{{ $student->fee_amount }}</td>
                                                    <td>{{ $student->fee_balance }}</td>
                                                   
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
   
@endsection
