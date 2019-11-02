@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">購入履歴</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">購入時間</th>
                                <th scope="col">ノートタイトル</th>
                                <th scope="col">コイン</th>
                                <th scope="col">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($records as $record)
                            <tr>
                                @php
                                $note = App\Note::find($record->note_id);
                                @endphp
                                <th scope="row">{{ $record->created_at }}</th>
                                <td>
                                    {{ $note->title }} / <i class="fas fa-id-badge"></i> {{ App\User::find($note->user_id)->name }}
                                </td>
                                <td><i class="fas fa-coins"></i> {{ $note->coin }}</td>
                                @if ($note->user_id == Auth::id() or App\Record::where('user_id', Auth::id())->where('note_id', $note->id)->first())
                                <td><a role="button" href="{{ $note->filepath }}" class="btn btn-success btn-sm">ダウンロード</a></td>
                                @else
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                                        購入
                                    </button>
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">このノートを購入しますか</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="{{ route('purchase', ['id' => $note->id] ) }}">
                                                    <div class="modal-body">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label class="col-3 col-form-label">タイトル</label>
                                                            <div class="col">
                                                                <input type="text" readonly class="form-control-plaintext" value="{{ $note->title }}">
                                                            </div>
                                                            <label class="col-3 col-form-label">コイン</label>
                                                            <div class="col">
                                                                <input type="text" readonly class="form-control-plaintext" value="{{ $note->coin }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">いいえ</button>
                                                        <button type="submit" class="btn btn-primary">はい</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                </div>
                </td>
                @endif
                </tr>
                @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection