@extends('backend.layouts.app')

@section('title', 'Products list')

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Product list</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="product-list" class="table table-bordered table-striped table-responsive table-hover" >
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Present Price</th>
                    <th>Discount Price</th>
                    <th>Stock</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->slug }}</td>
                    <td>{{ $product->present_price }}</td>
                    <td>{{ $product->discount_price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <a href="#"><i class="fa fa-search-plus fa-lg" style="color:green" aria-hidden="true"></i> </a>
                        <a href="{{ route('backend.product.edit',['id'=> $product->id]) }}"><i class="fa fa-pencil-square fa-lg" style="color:dodgerblue" aria-hidden="true"></i> </a>
                        <a href=""><i class="fa fa-trash fa-lg deletebtn" data-id="{{ $product->id }}"
                                      data-name="{{ $product->name }}" data-token="{{ @csrf_token() }}" style="color:red"></i> </a>
                    </td>

                </tr>
                @endforeach

                </tbody>
                <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Present Price</th>
                    <th>Discount Price</th>
                    <th>Stock</th>
                    <th>Updated</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>


@endsection


@push('scripts')


    {{-- DataTable js --}}
    <link rel="stylesheet" href="{{asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <script src="{{asset('backend/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{asset('backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(function () {
            $('#product-list').DataTable();
        });

        $(document).on('click', '.deletebtn', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var token = $(this).data('token');
            var name = $(this).data('name');
            swal({
                    title: "Are you sure!",
                    text:"Delete "+name + " ?",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes!",
                    showCancelButton: true,
                    dangerMode: true,
                }).then(function (isConfirm) {
                    if(isConfirm){
                        swal({
                            title: 'Successful!',
                            text: 'Product has been deleted!',
                            icon: 'success'
                        }).then(function() {
                            $.ajax({
                                type: "POST",
                                url: "{{ route('backend.product.destroy') }}",
                                data: {id:id, _token:token},
                                success: function (data) {
                                    if(data.success == true){ // if true (1)
                                        setTimeout(function(){// wait for 5 secs(2)
                                            location.reload(); // then reload the page.(3)
                                        }, 5000);
                                    }
                                }
                            });
                        });
                    }
                
            })
        });
    </script>
@endpush