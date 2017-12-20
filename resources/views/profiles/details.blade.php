@extends('master.master')

@section('css')
@parent
<link rel="stylesheet" href="{{asset('plugins/jstree/dist/themes/default/style.css')}}">
@stop

@section('content')
<div class="box box-warning">
    <div class="box-header">
        <h3 class="box-title">Permissões do perfil</h3>
    </div>
    <div class="box-body">
        <h4>
            <i class="fa fa-folder-open-o"></i>
            {{$profile->prf_name}} - {{$profile->prf_description}}
        </h4>
        <div class="row">
            <div id="container">
                <ul>
                    @foreach($permissions as $permissionByResource)
                            <li id="rsc-{{$permissionByResource->first()->resource->rsc_id}}" data-jstree='{"opened": true}'>
                                <a href="#">
                                    {{$permissionByResource->first()->resource->rsc_name}} - {{$permissionByResource->first()->resource->rsc_description}}
                                </a>
                                <ul>
                                    @foreach($permissionByResource as $permission)
                                        <li 
                                            id="prm-{{$permission->prm_id}}" 
                                            data-jstree='{"icon": "fa fa-shield" @if($profilePermissions->where("prm_id", $permission->prm_id)->count()),"selected": true @endif}'>
                                            {{$permission->prm_method}} - {{$permission->prm_description}}
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
@parent
<script src="{{asset('plugins/jstree/dist/jstree.js')}}"></script>
<script src="{{asset('plugins/axios/dist/axios.js')}}"></script>

<script type="text/javascript">

    $(document).ready(function () {
        var tree = $('#container').jstree({
            "checkbox" : {
                "keep_selected_style" : false
            },
            "plugins" : [ "checkbox" ]
        })

        tree.on('changed.jstree', function (e, data) {
            var permissions = data.selected.filter(function (node) {
                return node.split('-')[0] == 'prm'
            })
            .map(function (permissions) {
                return permissions.split('-')[1]
            })
            
            axios.post("{{baseUrl('/profiles/setpermissions/' . $profile->prf_id)}}", {permissions: permissions})
        })
    })

</script>
@stop