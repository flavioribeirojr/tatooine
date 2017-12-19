@extends('master.master')

@section('css')
@parent
<link rel="stylesheet" href="{{asset('theme/plugins/iCheck/all.css')}}">

<style>
    .small-box-footer label {
        margin-bottom: 0;
    }

    .small-box>.small-box-footer, .small-box>.small-box-footer:hover {
        text-align: right;
        padding-right: 10px;
        background-color: #f9f8f8;
        box-shadow: 0px 1px 1px #c5adad;
    }

    .small-box>.inner {
        padding-right: 80px;
    }
</style>
@stop

@section('content')

<div class="box box-warning">
    <div class="box-header">
        <h3 class="box-title">Perfis do usuário</h3>
    </div>
    <div class="box-body">
        <h4>
            <i class="fa fa-user-o"></i>
            {{$user->usr_name}}
        </h4>
        <div class="row">
            @foreach ($profiles as $profile)
            <div class="col-md-4">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{$profile->prf_name}}</h3>
        
                        <p style="height: 2em">{{$profile->prf_description}}</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <a class="small-box-footer">
                        <label>
                            <input 
                                type="checkbox" 
                                name="prf_id"
                                value="{{$profile->prf_id}}"
                                @if(in_array($profile->prf_id, $userProfiles))
                                checked
                                @endif
                            />
                        </label>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@stop

@section('js')
@parent
<script src="{{asset('theme/plugins/iCheck/icheck.min.js')}}"></script>
<script src="{{asset('plugins/axios/dist/axios.js')}}"></script>
<script>

    $(document).ready(function () {
        var iCheck = $('input').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_square-green',
        })

        iCheck.on('ifChecked', function (e) {
            var data = {
                profile: e.target.value,
                user: '{{$user->usr_id}}'
            };
            
            axios.post("{{baseUrl('/users/setprofile')}}", data)
        })

        iCheck.on('ifUnchecked', function (e) {
            var data = {
                profile: e.target.value,
                user: '{{$user->usr_id}}'
            };
            
            axios.post("{{baseUrl('/users/unsetprofile')}}", data)
        })
    })
</script>
@stop