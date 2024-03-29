@extends('layout.header')@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>TakenBook</h3>
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
                    <div class="x_content">
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
                        <br />
                        <form enctype="multipart/form-data" data-parsley-validate
                            class="form-horizontal form-label-left" method="POST"
                            action="{{ route('taken_books.store') }}">@csrf<div class="item form-group"><label
                                    class="col-form-label col-md-3 col-sm-3 label-align" for="book_id">Book <span
                                        class="required">*</span></label>
                                <div class="col-sm-6"><select class="form-control" name="book_id">
                                        <option value="">Select Book </option>
                                        @foreach ($book_ids as $book_id)
                                            <option value="{{ $book_id->id }}">{{ $book_id->book_title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="qty">Qty <span class="required">*</span></label>
                                <div class="col-sm-6"><input type="text" id="qty" name="qty"
                                        required="required" class="form-control "></div>
                            </div>
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="library_member_id">Library member <span class="required">*</span></label>
                                <div class="col-sm-6"><select class="form-control" name="library_member_id">
                                        <option value="">Select Library member </option>
                                        @foreach ($library_member_ids as $library_member_id)
                                            <option value="{{ $library_member_id->id }}">{{ $library_member_id->name }}
                                            </option>
                                        @endforeach
                                    </select></div>
                            </div>
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="taken_date">Taken date <span class="required">*</span></label>
                                <div class="col-sm-6"><input type="date" id="taken_date" name="taken_date"
                                        required="required" class="form-control "></div>
                            </div>
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="returning_date">Returning date <span class="required">*</span></label>
                                <div class="col-sm-6"><input type="date" id="returning_date" name="returning_date"
                                        required="required" class="form-control "></div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-6 offset-3"><button type="submit"
                                        class="btn btn-sm btn-success">Submit</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
