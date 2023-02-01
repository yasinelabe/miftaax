@extends('layout.header')
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">

            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>New income</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>

                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <form action="/finance/store_income" method="post" class="form-horizontal form-label-left">
                                @csrf
                                @if (Session::has('success'))
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6">
                                            <p id="alert"
                                                class="alert {{ Session::get('alert-class', 'alert-success') }}">
                                                {{ Session::get('message') }}</p>
                                        </div>
                                    </div>
                                @endif

                                {{-- loop through all form validation errors --}}
                                @if ($errors->any())
                                    <div class="row alert-danger">

                                        <div class="col-md-3"></div>
                                        <div class="col-md-6">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif


                                {{-- title --}}
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="title">Description
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="description" name="description" required="required"
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="title">Category
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select name="income_category_id" id="" class="form-control">
                                       @foreach ($income_categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                       @endforeach
                                    </select>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="/finance/new_income_category" class="btn btn-sm btn-success">New</a>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="title">Type
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select name="income_type_id" id="" class="form-control">
                                       @foreach ($income_types as $type)
                                            <option value="{{$type->id}}">{{$type->name}}</option>
                                       @endforeach
                                    </select>
                                    </div>
                                </div>

                                {{-- amount --}}
                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="amount">Amount
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="number" id="amount" name="amount" required="required"
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="item form-group">
                                    <div class="col-md-6 col-sm-6 offset-md-3">
                                        <button class="btn btn-success" type="reset">Reset</button>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection