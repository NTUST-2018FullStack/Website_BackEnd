@extends('layouts.master')

@section('title', '新增商品')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                商品管理
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-shopping-bag"></i> 商品管理</a></li>
                <li class="active">新增商品</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <div class="row">
                <!-- .col -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">新增商品</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">

                            @csrf

                            <div class="box-body">

                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                            &times;
                                        </button>
                                        <h4><i class="icon fa fa-ban"></i> 錯誤！</h4>
                                        請修正以下表單錯誤：
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label for="title">名稱</label>
                                    <input type="text" class="form-control" id="title" name="name" placeholder="請輸入名稱"
                                           value="{{ old('name') }}">
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select id="category_id" name="category_id" class="form-control">
                                        @foreach($categories as $category)
                                            <option
                                                value="{{ $category->id }}"{{ (old('category_id') == $category->id)? ' selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="listprice">ListPrice</label>
                                    <input type="text" class="form-control" id="listprice" name="listprice"
                                           placeholder="請輸入價格" value="{{ old('listprice') }}">
                                </div>
                                <div class="form-group">
                                    <label for="saleprice">SalePrice</label>
                                    <input type="text" class="form-control" id="saleprice" name="saleprice"
                                           placeholder="請輸入價格" value="{{ old('saleprice') }}">
                                </div>
                                <div class="form-group">
                                    <label for="unit">單位</label>
                                    <input type="text" class="form-control" id="unit" name="unit" placeholder="請輸入單位"
                                           value="{{ old('unit') }}">
                                </div>
                                <div class="form-group">
                                    <label for="description">描述</label>
                                    <textarea class="form-control" id="description" name="description" rows="5"
                                              placeholder="請輸入描述">{{ old('description') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="cover">產品圖</label>
                                    <input type="file" id="image" name="image">
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer text-right">
                                <a class="btn btn-link" href="{{route('products.index')}}">取消</a>
                                <button type="submit" class="btn btn-primary">新增</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
