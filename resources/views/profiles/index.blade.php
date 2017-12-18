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
<h2 class="page-title">Perfis</h2>
<div class="box box-warning">
    <div class="box-header">
        <h3 class="box-title">Perfis cadastrados</h3>
        <action
            action="profiles/create"
            aclass="btn btn-primary"
            icon="fa fa-plus"
            type="anchor"
            class="btn-create"
        >
            Criar novo perfil
        </action>
    </div>
    <div class="box-body">
        <data-grid 
            url="{{baseUrl('/profiles/list')}}"
            primary-key="prf_id"
            :user-fields="{prf_name: 'Perfil', prf_description: 'Descrição'}"
            :user-filters="{
                prf_name: {type: 'text', size: 12}
            }"
            :actions="[{method: 'edit', url: 'profiles/edit'}, {method: 'delete', url: 'profiles/delete'}, {method: 'details', url: 'profiles/details'}]"
        >
        </data-grid>
    </div>
</div>  
@stop