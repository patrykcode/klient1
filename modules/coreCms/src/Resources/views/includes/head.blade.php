<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
<script src="{{asset('admin/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('admin/js/admin.js')}}"></script>
<script src="{{asset('admin/js/alerts.js')}}"></script>
<link type="text/css" rel="stylesheet" href="{{asset('admin/css/alerts.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('admin/fa470/css/font-awesome.css')}}">
<link type="text/css" rel="stylesheet" href="{{asset('admin/css/admin.css')}}">
<script>
    $(document).ready(function () {
        var ckeditr = document.querySelectorAll('.ckedit');
        if (ckeditr.length) {
            for (var i = 0; i < ckeditr.length; i++) {
                CKEDITOR.replace(document.querySelector('[name="' + ckeditr[i].name + '"]'), {
                    filebrowserBrowseUrl: '/elfinder',
                });
            }
        }
    });
</script>