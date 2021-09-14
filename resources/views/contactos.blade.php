@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Contactos') }}</div>

                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>created_at</th>
                            <th>name</th>
                            <th>date_birth</th>
                            <th>phone</th>
                            <th>address</th>
                            <th>credit_card</th>
                            <th>franchise</th>
                            <th>email</th>
                        </tr>
                        @if(count($contactos) > 0)
                        @foreach ($contactos as $row)
                            <tr>
                                <td>{{$row->created_at}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->date_birth}}</td>
                                <td>{{$row->phone}}</td>
                                <td>{{$row->address}}</td>
                                <td>{{$row->credit_card}}</td>
                                <td>{{$row->franchise}}</td>
                                <td>{{$row->email}}</td>
                            </tr>
                        @endforeach
                        @else
                            <tr>
                                <td colspan="8">No hay registros</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
