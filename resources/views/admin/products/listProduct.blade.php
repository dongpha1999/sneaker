@extends('admin.layouts.index')


@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sản phẩm
                    <small>Danh sách</small>
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
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>#</th>
                        <th>Mã sản phẩm</th>
                        <th>Ảnh sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá tiền</th>
                        <th>Danh mục sản phẩm</th>
                        <th>Thương hiệu</th>
                        <th>Số lượng</th>
                        <th>Tình trạng</th>
                        <th>Hiển thị</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $count = 1;
                    @endphp
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $product->sku }}</td>
                            <td><img src="{{ asset('storage/images/products/'.$product->image_path) }}" width=60px ></td>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->cate_title }}</td>
                            <td>{{ $product->brand_name }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>
                                @php
                                    if($product->quantity > 0){
                                        if($product->quantity > 5){
                                            echo "Còn hàng";
                                        }else{
                                            echo "Sắp hết";
                                        }
                                    }else{
                                        echo "Hết hàng";
                                    }
                                @endphp
                            </td>
                            <td> 
                                @if ($product->status === 1)
                                    @if ($product->quantity > 0)
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    @else
                                     <i class="fa fa-times" aria-hidden="true"></i>
                                    @endif
                                @else
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('product.delete',['id'=>$product->id]) }}" onclick="return confirm('Bạn có muốn xóa sản phẩm này ?');"><i class="fa fa-times" aria-hidden="true"></i></a>
                                <a href="{{ route('product.edit.form',['id'=>$product->id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                <a href="{{ route('product.disable',['id'=>$product->id]) }}" style="margin-right:1rem;"><i class="fa fa-ban" aria-hidden="true"></i></a>
                                <a href="{{ route('product.enable',['id'=>$product->id]) }}"><i class="fa fa-check-square" aria-hidden="true"></i></i></a>
                            </td>
                        </tr>
                        @php
                            $count++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection