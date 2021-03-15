@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Exito al crear el producto</div>

                <div class="card-body">
                    El producto creado, se guardo con el nombre: {{ $data }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection