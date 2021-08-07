@extends('admin.layouts.index')


@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thương hiệu sản phẩm
                    <small>Sửa</small>
                </h1>
                @if(Session::has('invalid'))
                <div class="alert alert-danger alert-dismissible">
                     <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     {{Session::get('invalid')}}
                </div>
           @endif
           @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible">
                     <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     {{Session::get('success')}}
                </div>
           @endif
                <form action="{{ route('brand.edit',['id' => $brand['id']]) }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="form-group">
                        <label for="brand-name">Tên danh mục:</label>
                        <input type="text" class="form-control" placeholder="Nhập tên thương hiệu" id="brand-name" name="brand-name" value='{{ $brand['name'] }}' required>
                    </div>
                    <div class="form-group">
                        <label for="image">Chọn hình ảnh</label>
                        <input id="image" type="file" name="image">
                    </div>
                    <img src="{{ asset('storage/images/brands/'.$brand['img_path']) }}" width=80 height=80>
                    <br /><br />
                    <button type="submit" class="btn btn-primary">Sửa</button>
                    <a href="{{ route('brand.back') }}" type="button" class="btn btn-danger">Quay lại</a>
                  </form>
            </div>
        </div>
    </div>   
</div>
@endsection