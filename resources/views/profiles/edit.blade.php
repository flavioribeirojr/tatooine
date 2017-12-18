@extends('master.master')

@section('content')

<div class="box box-warning">
    <div class="box-header">
        <h1 class="box-title">Atualizar perfil</h1>
    </div>
    <div class="box-body">
        <form action="{{baseUrl('/profiles/update/'. $profile->prf_id)}}" method="POST">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">
            @include('profiles.includes.form')
        </form>
    </div>
</div>

@stop