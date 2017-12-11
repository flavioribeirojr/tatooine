@extends('master.master')

@section('content')
<!-- <action
        action="users/create"
        aclass="btn btn-primary" 
        message="Criar novo usuário"
    >
    </action> -->
<h2 class="page-title">Usuários</h2>
<div class="box box-warning">
    <div class="box-header">
        <h3 class="box-title">Usuários cadastrados</h3>
    </div>
    <div class="panel-body">
        <data-grid 
            url="{{url(baseUrl('/users/list'))}}"
            :user-fields="{usr_name: 'User', usr_email: 'E-mail', usr_username: 'Username', usr_enabled: 'Status'}"
            :user-filters="{usr_name: 'text', usr_enabled: 'select'}"
        >
        </data-grid>
    </div>
</div>  

@stop