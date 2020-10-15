@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">後台</a></li>
            <li class="breadcrumb-item active" aria-current="page">商品類別管理</li>
        </ol>

        <a href="/admin/productType/create" class="btn btn-success mb-3">新增商品類別</a>
    </nav>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Sort</th>
                <th>商品類別</th>
                <th width="120px">編輯</th>
            </tr>
        </thead>
        <tbody>
            {{-- {{$product_types->type_name}} --}}
            @foreach ($product_types as $product_type)
            <tr>
                <td>{{$product_type->sort}}</td>
                <td>{{$product_type->type_name}}</td>

                <td>
                    <a href="/admin/productType/{{$product_type->id}}/edit" class="btn btn-sm btn-info">編輯</a>
                    {{-- <a href="product/destroy/{{$value->id}}" class="btn btn-sm btn-danger">刪除</a> --}}
                    <button data-ptid="{{$product_type->id}}" class="btn btn-sm btn-danger btn-delete">刪除</button>
                    <form id="logout-form-{{$product_type->id}}" action="/admin/productType/{{$product_type->id}}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('js')

    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    {{-- 刪除按鈕事件js --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                "order": [[ 1, "desc" ]],
                language: {
                        "processing":   "處理中...",
                        "loadingRecords": "載入中...",
                        "lengthMenu":   "顯示 _MENU_ 項結果",
                        "zeroRecords":  "沒有符合的結果",
                        "info":         "顯示第 _START_ 至 _END_ 項結果，共 _TOTAL_ 項",
                        "infoEmpty":    "顯示第 0 至 0 項結果，共 0 項",
                        "infoFiltered": "(從 _MAX_ 項結果中過濾)",
                        "infoPostFix":  "",
                        "search":       "搜尋:",
                        "paginate": {
                            "first":    "第一頁",
                            "previous": "上一頁",
                            "next":     "下一頁",
                            "last":     "最後一頁"
                        },
                        "aria": {
                            "sortAscending":  ": 升冪排列",
                            "sortDescending": ": 降冪排列"
                        }
                    }
            });
        });

        $("#example").on("click", ".btn-delete", function(){
                var product_type_id = this.dataset.ptid;
                // console.log(product_type_id);
                    Swal.fire({
                        title: '你確定嗎?',
                        text: "刪除此類別將會一起刪除包含於此類別的商品，你將無法還原他!!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // console.log('logout-form-'+product_type_id);
                            $('#logout-form-'+product_type_id).submit();

                        }
                    })
        });

    </script>

@endsection
