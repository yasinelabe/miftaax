@extends('layout.header')@section('content')
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
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="fee_type_id">Fee type <span class="required">*</span></label>
                                <div class="col-sm-6"><select onchange="handleFeeType(this)" class="form-control"
                                        name="fee_type_id">
                                        <option value="">Select Fee type </option>
                                        @foreach ($fee_type_ids as $fee_type_id)
                                            <option value="{{ $fee_type_id->id }}">{{ $fee_type_id->name }}</option>
                                        @endforeach
                                    </select></div>
                            </div>

                            <div id="months" class="item hidden form-group"><label
                                    class="col-form-label col-md-3 col-sm-3 label-align" for="month">Month <span
                                        class="required">*</span></label>
                                <div class="col-sm-6">
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
                            </div>

                            <div id="amounts" class="item hidden form-group"><label
                                    class="col-form-label col-md-3 col-sm-3 label-align" for="name">Amount <span
                                        class="required">*</span></label>
                                <div class="col-sm-6"><input type="number" id="amount" name="amount"
                                        class="form-control "></div>
                            </div>

                            <div id="choices" class="item  form-group"><label
                                    class="col-form-label col-md-3 col-sm-3 label-align" for="name"> <span
                                        class="required">*</span></label>
                                <div class="col-sm-6">
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


                            <div id="students" class="item hidden form-group">

                                <div class="col-sm-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <a href="#" class="btn btn-sm btn-success">
                                                        <i class="fa fa-plus"></i>
                                                    </a>
                                                </th>

                                                <th>
                                                    Student
                                                </th>
                                                <th>Class</th>
                                                <th>Unpaid Balance</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>

                            </div>

                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-6 offset-3"><button type="submit" class="btn btn-sm btn-success"><i
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
</script>
@endsection
