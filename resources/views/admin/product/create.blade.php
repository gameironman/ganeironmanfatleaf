@extends('layouts.app')

@section('css')
<<<<<<< HEAD

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

=======
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
>>>>>>> 1e306d5115dbc710e46eea1e2c77a07d1b8f5857
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin">後台</a></li>
        <li class="breadcrumb-item"><a href="/admin/product">商品管理</a></li>
        <li class="breadcrumb-item active" aria-current="page">新增最新商品</li>
    </ol>
</nav>
<form method="POST" action="/admin/product/store" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">商品名稱 <small class="text-danger">最多20個字</small></label>
        <input type="text" class="form-control" id="name" aria-describedby="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="image">上傳圖片 <small class="text-danger">圖片寬高比例為4:3</small></label>
        <input type="file" class="form-control-file" id="image" name="image">
<<<<<<< HEAD
      </div>
      <div class="form-group">
        <label for="multiple_image">多重圖片 <small class="text-danger">圖片寬高比例為4:3</small></label>
        <input type="file" class="form-control-file" id="multiple_image" name="multiple_image[]" multiple required>
      </div>

=======
    </div>
    <div class="form-group">
        <label for="multiple-images">上傳多張圖片 <small class="text-danger">圖片寬高比例為4:3</small></label>
        <input type="file" class="form-control-file" id="multiple-image" name="multiple-image[]" multiple required>
    </div>
>>>>>>> 1e306d5115dbc710e46eea1e2c77a07d1b8f5857
    <div class="form-group">
        <label for="product_type_id">商品類別</label>
        <select class="form-control" id="product_type_id" name="product_type_id">
          @foreach ($product_types as $product_type)
          <option value="{{$product_type->id}}">{{$product_type->type_name}}</option>
          @endforeach
          {{-- <option value="1">飯類</option>
          <option value="2">麵類</option>
          <option value="3">飲品</option>
          <option value="4">湯類</option> --}}
        </select>
    </div>
    <div class="form-group">
        <label for="price">價格</label>
        <input type="text" class="form-control" id="price" aria-describedby="price" name="price" required>
    </div>
    <div class="form-group">
        <label for="info">介紹</label>
        <textarea class="form-control" id="info" rows="3" name="info"></textarea>
      </div>
    <div class="form-group">
        <label for="date">上市日期</label>
        <input type="text" class="form-control" id="date" aria-describedby="date" name="date">
        <div class="form-group">
            <label for="content">內容</label>
            <textarea class="form-control" id="content" rows="3" name="content"></textarea>
          </div>
    </div>

    <button type="submit" class="btn btn-primary">送出</button>
</form>

@endsection

@section('js')

<<<<<<< HEAD
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/lang/summernote-zh-TW.min.js" integrity="sha512-QwmFqNXzMuXrWliMHyf5PZTJBdoq1gsCwUyM6ffVk+4/N+R76EFwLWM/6lszVVD8Zza3xd6v16Nl6ApsqTr+sg==" crossorigin="anonymous"></script>
    <Script>
    //  $(document).ready(function() {
            // $('#summernote').summernote();
    $(document).ready(function() {
        $('#content').summernote({
=======
{{-- summernote js --}}
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="/js/summernote/lang_ZH_TW.js"></script>

<script>
     $(document).ready(function() {
        $('#info').summernote({
>>>>>>> 1e306d5115dbc710e46eea1e2c77a07d1b8f5857
            height: 150,
            lang: 'zh-TW',
            callbacks: {
                onImageUpload: function(files) {
                    for(let i=0; i < files.length; i++) {
                        $.upload(files[i]);
                    }
                },
                onMediaDelete : function(target) {
                    $.delete(target[0].getAttribute("src"));
                }
            },
<<<<<<< HEAD
=======
            popover: {
                image: [
                    ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                    ['float', ['floatLeft', 'floatRight', 'floatNone']],
                    ['remove', ['removeMedia']]
                ],
                link: [
                    ['link', ['linkDialogShow', 'unlink']]
                ],
                table: [
                    ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                    ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
                ],
                air: [
                    ['color', ['color']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['para', ['ul', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']]
                ]
            }
>>>>>>> 1e306d5115dbc710e46eea1e2c77a07d1b8f5857
        });


        $.upload = function (file) {
            let out = new FormData();
            out.append('file', file, file.name);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: 'POST',
                url: '/admin/ajax_upload_img',
                contentType: false,
                cache: false,
                processData: false,
                data: out,
                success: function (img) {
<<<<<<< HEAD
                    $('#content').summernote('insertImage', img);
=======
                    $('#info').summernote('insertImage', img);
>>>>>>> 1e306d5115dbc710e46eea1e2c77a07d1b8f5857
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + " " + errorThrown);
                }
            });
        };

        $.delete = function (file_link) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: 'POST',
                url: '/admin/ajax_delete_img',
                data: {file_link:file_link},
                success: function (img) {
                    console.log("delete:",img);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + " " + errorThrown);
                }
            });
        }
<<<<<<< HEAD

   });






    </Script>
=======
   });
</script>
>>>>>>> 1e306d5115dbc710e46eea1e2c77a07d1b8f5857
@endsection
