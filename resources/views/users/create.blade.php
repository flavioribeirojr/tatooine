@extends('master.master')

@section('content')

<div class="box box-warning">
    <div class="box-header">
        <h1 class="box-title">Cadastro de usuário</h1>
    </div>
    <div class="box-body">
        <form action="{{baseUrl('/users/store')}}" method="POST">
            {{csrf_field()}}
            @include('users.includes.form')
        </form>
    </div>
</div>

@stop