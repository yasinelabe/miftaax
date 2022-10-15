@extends('layout.header') @section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Student profile</h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5  form-group pull-right top_search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" type="button">Go!</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="col-md-3 col-sm-3  profile_left">
                                <div class="profile_img">
                                    <div id="crop-avatar">
                                        <!-- Current avatar -->
                                        <img class="img-responsive avatar-view" src="images/picture.jpg" alt="Avatar"
                                            title="Change the avatar">
                                    </div>
                                </div>
                                <h3>{{ $student->fullname }}</h3>

                                <ul class="list-unstyled user_data">
                                    <li><i class="fa fa-map-marker user-profile-icon"></i> {{ $student->address }}
                                    </li>

                                    <li>
                                        <i class="fa fa-cake user-profile-icon"></i> {{ $student->date_of_birth }}
                                    </li>

                                </ul>


                            </div>
                            <div class="col-md-9 col-sm-9 ">

                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab"
                                                role="tab" data-toggle="tab" aria-expanded="true">Details</a>
                                        </li>
                                        <li role="presentation" class=""><a href="#tab_content2" role="tab"
                                                id="profile-tab" data-toggle="tab" aria-expanded="false">Fees</a>
                                        </li>
                                        <li role="presentation" class=""><a href="#tab_content3" role="tab"
                                                id="profile-tab2" data-toggle="tab" aria-expanded="false">Exam results</a>
                                        </li>
                                    </ul>
                                    <div id="myTabContent" class="tab-content">
                                        <div role="tabpanel" class="tab-pane active " id="tab_content1"
                                            aria-labelledby="home-tab">
                                            <p>Empty now</p>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="tab_content2"
                                            aria-labelledby="profile-tab">

                                            <!-- start user projects -->
                                            <table class="data table table-striped no-margin">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Fee</th>
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
                                            <!-- end user projects -->

                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="tab_content3"
                                            aria-labelledby="profile-tab">
                                            <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin
                                                coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next
                                                level wes anderson artisan four loko farm-to-table craft beer twee. Qui
                                                photo booth letterpress, commodo enim craft beer mlkshk </p>
                                        </div>
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