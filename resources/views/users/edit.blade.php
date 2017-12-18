@extends('master.master')

@section('content')

<div class="box box-warning">
    <div class="box-header">
        <h1 class="box-title">Atualizar usuário</h1>
    </div>
    <div class="box-body">
        <form action='{{baseUrl("/users/update/{$user->usr_id}")}}' method="POST">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="usr_id" value="{{$user->usr_id}}">
            @include('users.includes.form')
        </form>
    </div>
</div>

@stop