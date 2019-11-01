@extends('layouts.app')

@section('content')
<div class="container">
    <div style="margin: 10px 0;">
        <button type="button" class="btn btn-primary">自分のノートをシェアする</button>
    </div>
    <div class="row justify-content-center">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">公開中のノート</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ノートタイトル</th>
                                <th scope="col">コイン</th>
                                <th scope="col">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>
                                    ノートタイトル / <i class="fas fa-id-badge"> 山田</i>
                                </td>
                                <td><i class="fas fa-coins"></i> 200</td>
                                <td><button type="button" class="btn btn-primary btn-sm">購入</button></td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection