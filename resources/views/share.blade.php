@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>ノートタイトル</label>
                    <input type="text" class="form-control" name="title" placeholder="ノートのタイトルを入力してください">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">コイン数</label>
                    <select class="form-control" name="coin" id="exampleFormControlSelect1">
                        <option>100</option>
                        <option>200</option>
                        <option>300</option>
                        <option>400</option>
                        <option>500</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">ノートファイル</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile02" name="notefile">
                        <label class="custom-file-label" for="inputGroupFile02">*.PDFのみ</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">シェア</button>
            </form>
        </div>
    </div>
</div>
<script>
    $('#inputGroupFile02').on('change', function() {
        var fileName = $(this).val();
        $(this).next('.custom-file-label').html(fileName);
    })
</script>
@endsection