<form action="{{ route("dashTransfe") }}" id="transf{{ $id }}{{ $type }}" method="POST" class="form-horizontal"
    enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="currency_id" value="{{ $divisa }}">
    <input type="hidden" name="account_id" value="{{ $id }}">
    <input style="display:none;" type="file" id="filex{{ $id }}{{ $type }}" name="filex">
    <button type="button" class="btn btn-upload-two mt-3 py-2" id="upload{{ $id }}{{ $type }}">
        
        @lang('dash_general.upload_file')
    </button>

    <button type="submit" class="btn btn-info mt-2 py-2 btn-block ">
        <span class="mr-1"><img src="assets/img/deposito/icon3.png" alt=""></span>
       @lang('dash_general.send_deposit')
    </button>

</form>

<script>
    $(document).ready(function() {
        $('#upload{{ $id }}{{ $type }}').click(function() {
            $('#filex{{ $id }}{{ $type }}').click();
        });
    });

</script>
