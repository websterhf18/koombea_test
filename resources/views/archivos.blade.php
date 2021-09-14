@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Archivos') }}</div>

                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Filename</th>
                            <th>Created At</th>
                            <th>Status</th>
                        </tr>
                        @if(count($archivos) > 0)
                        @foreach ($archivos as $row)
                            <tr>
                                <td>{{$row->filename}}</td>
                                <td>{{$row->created_at}}</td>
                                <td>{{$row->status}}</td>
                            </tr>
                        @endforeach
                        @else
                            <tr>
                                <td colspan="3">No hay registros</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
