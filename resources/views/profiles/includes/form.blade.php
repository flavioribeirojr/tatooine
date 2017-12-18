<div class="row">
    <div class="col-md-4 form-group @if($errors->has('prf_name')) has-error @endif">
        <label for="prf_name" class="label-control">Perfil*</label>
        <div class="controls">
            <input type="text" name="prf_name" class="form-control" value="{{empty($profile) ? old('prf_name') : $profile->prf_name}}">
            @if($errors->has('prf_name')) <p class="text-danger">{{$errors->first('prf_name')}}</p> @endif
        </div>
    </div>

    <div class="col-md-8 form-group @if($errors->has('prf_description')) has-error @endif">
        <label for="prf_description" class="label-control">Descrição*</label>
        <div class="controls">
            <input type="text" name="prf_description" class="form-control" value="{{empty($profile) ? old('prf_description') : $profile->prf_description}}">
            @if($errors->has('prf_description')) <p class="text-danger">{{$errors->first('prf_description')}}</p> @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 text-right">
        <button type="submit" class="btn btn-success btn-lg">Salvar</button>
    </div>
</div>