@extends('master.master')

@section('css')
@parent

<style>
    .data-grid-actions {
        width: 15%;
    }
</style>

@stop

@section('content')
<h2 class="page-title">Usuários</h2>
<div class="box box-warning">
    <div class="box-header">
        <h3 class="box-title">Usuários cadastrados</h3>
        <action
            action="users/create"
            aclass="btn btn-primary"
            icon="fa fa-plus"
            type="anchor"
            class="btn-create"
        >
            Criar novo usuário
        </action>
    </div>
    <div class="panel-body">
        <data-grid 
            url="{{url(baseUrl('/users/list'))}}"
            primary-key="usr_id"
            :user-fields="{usr_name: 'User', usr_email: 'E-mail', usr_username: 'Username', usr_enabled: 'Status'}"
            :user-filters="{
                usr_name: {type: 'text', size: 4}, 
                usr_enabled: {type: 'select', size: 3, options: {1: 'Enabled', 0: 'Disabled'}}
            }"
            :actions="[{method: 'edit', url: 'users/edit'}, {method: 'delete', url: 'users/delete'}, {method: 'details', url: 'users/details'}]"
        >
        </data-grid>
    </div>
</div>  

@stop