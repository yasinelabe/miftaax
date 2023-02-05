@extends('layout.header')@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Book</h3>
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
                            class="form-horizontal form-label-left" method="POST" action="{{ route('books.store') }}">
                            @csrf<div class="item form-group"><label
                                    class="col-form-label col-md-3 col-sm-3 label-align" for="book_title">Book title
                                    <span class="required">*</span></label>
                                <div class="col-sm-6"><input type="text" id="book_title" name="book_title"
                                        required="required" class="form-control "></div>
                            </div>
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="cover_image">Cover image <span class="required">*</span></label>
                                <div class="col-sm-6"><input type="file" id="cover_image" name="cover_image"
                                        required="required" class="form-control "></div>
                            </div>
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="book_category_id">Book category <span class="required">*</span></label>
                                <div class="col-sm-6"><select class="form-control" name="book_category_id">
                                        <option value="">Select Book category </option>
                                        @foreach ($book_category_ids as $book_category_id)
                                            <option value="{{ $book_category_id->id }}">{{ $book_category_id->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="book_type_id">Book type <span class="required">*</span></label>
                                <div class="col-sm-6"><select class="form-control" name="book_type_id">
                                        <option value="">Select Book type </option>
                                        @foreach ($book_type_ids as $book_type_id)
                                            <option value="{{ $book_type_id->id }}">{{ $book_type_id->name }}</option>
                                        @endforeach
                                    </select></div>
                            </div>
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="shelf">Shelf <span class="required">*</span></label>
                                <div class="col-sm-6"><input type="text" id="shelf" name="shelf"
                                        required="required" class="form-control "></div>
                            </div>
                            <div class="item form-group"><label class="col-form-label col-md-3 col-sm-3 label-align"
                                    for="author_name">Author name <span class="required">*</span></label>
                                <div class="col-sm-6"><input type="text" id="author_name" name="author_name"
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
