@extends('master.master')

@section('content')

<div class="box box-warning">
    <div class="box-header">
        <h1 class="box-title">Cadastro de perfil</h1>
    </div>
    <div class="box-body">
        <form action="{{baseUrl('/profiles/store')}}" method="POST">
            {{csrf_field()}}
            @include('profiles.includes.form')
        </form>
    </div>
</div>

@stop