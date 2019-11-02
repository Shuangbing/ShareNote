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
                                    {{ $note->title }} <i class="fas fa-id-badge"></i> {{ App\User::find($note->user_id)->name }}
                                </td>
                                <td><i class="fas fa-coins"></i> {{ $note->coin }}</td>
                                <td><a role="button" href="{{ route('download', ['id' => $note->id] ) }}" class="btn btn-success btn-sm">ダウンロード</a></td>
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