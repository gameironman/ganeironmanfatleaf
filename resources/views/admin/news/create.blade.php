@extends('layouts.app')

@section('css')
<<<<<<< HEAD

<!-- summernote -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

=======
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
>>>>>>> 1e306d5115dbc710e46eea1e2c77a07d1b8f5857
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin">後台</a></li>
        <li class="breadcrumb-item"><a href="/admin/news">資料管理</a></li>
        <li class="breadcrumb-item active" aria-current="page">新增最新消息</li>
    </ol>
</nav>
<form method="POST" action="/admin/news/store" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title">標題 <small class="text-danger">最多20個字</small></label>
        <input type="text" class="form-control" id="title" aria-describedby="title" name="title" required>
    </div>
    <div class="form-group">
        <label for="img_url">上傳圖片 <small class="text-danger">圖片寬高比例為4:3</small></label>
        <input type="file" class="form-control-file" id="img_url" name="img_url">
      </div>
    <div class="form-group">
        <label for="sub_title">副標題</label>
        <input type="text" class="form-control" id="sub_title" aria-describedby="sub_title" name="sub_title" required>
    </div>
    
      <div class="form-group">
        <label for="content">內容</label>
        <textarea class="form-control" id="content" rows="3" name="content"></textarea>
      </div>
    <button type="submit" class="btn btn-primary">送出</button>
</form>

@endsection

@section('js')
{{-- summernote js --}}
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="/js/summernote/lang_ZH_TW.js"></script>

<script>

    $(document).ready(function() {
        $('#content').summernote({
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
                    $('#content').summernote('insertImage', img);
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

<<<<<<< HEAD
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/lang/summernote-zh-TW.min.js" integrity="sha512-QwmFqNXzMuXrWliMHyf5PZTJBdoq1gsCwUyM6ffVk+4/N+R76EFwLWM/6lszVVD8Zza3xd6v16Nl6ApsqTr+sg==" crossorigin="anonymous"></script>
    <Script>
    //  $(document).ready(function() {
            // $('#summernote').summernote();
    $(document).ready(function() {
        $('#content').summernote({
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
                    $('#content').summernote('insertImage', img);
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

=======
>>>>>>> 1e306d5115dbc710e46eea1e2c77a07d1b8f5857
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
