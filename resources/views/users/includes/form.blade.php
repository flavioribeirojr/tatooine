<div class="row">
    <div class="col-md-9 form-group @if($errors->has('usr_name')) has-error @endif">
        <label class="label-control" for="usr_name">Nome*</label>
        <div class="controls">
            <input type="text" name="usr_name" class="form-control" value="{{empty($user) ? old('usr_name') : $user->usr_name}}">
            @if($errors->has('usr_name')) <p class="text-danger">{{$errors->first('usr_name')}}</p> @endif
        </div>
    </div>
    <div class="col-md-3 form-group @if($errors->has('usr_enabled')) has-error @endif">
        <label class="label-control" for="usr_enabled">Status*</label>
        <div class="controls">
            <select name="usr_enabled" class="form-control" value="{{empty($user) ? old('usr_enabled') : $user->usr_enabled}}">
                <option @if(empty($user)) selected @endif hidden disabled value="">Selecione</option>
                <option value="1">Ativo</option>
                <option value="0">Cancelado</option>
            </select>
            @if($errors->has('usr_enabled')) <p class="text-danger">{{$errors->first('usr_enabled')}}</p> @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 form-group @if($errors->has('usr_username')) has-error @endif">
        <label class="label-control" for="usr_username">Nome de usuário*</label>
        <div class="controls">
            <input type="text" name="usr_username" class="form-control" value="{{empty($user) ? old('usr_username') : $user->usr_username}}">
            @if($errors->has('usr_username')) <p class="text-danger">{{$errors->first('usr_username')}}</p> @endif
        </div>
    </div>
    <div class="col-md-4 form-group @if($errors->has('usr_email')) has-error @endif">
        <label class="label-control" for="usr_email">E-mail*</label>
        <div class="controls">
            <input type="email" name="usr_email" class="form-control" value="{{empty($user) ? old('usr_email') : $user->usr_email}}">
            @if($errors->has('usr_email')) <p class="text-danger">{{$errors->first('usr_email')}}</p> @endif
        </div>
    </div>
    @if(empty($user))
    <div class="col-md-2 form-group @if($errors->has('usr_password')) has-error @endif">
        <label for="usr_password" class="label-control">Senha*</label>
        <div class="controls">
            <input type="password" name="usr_password" class="form-control">
            @if($errors->has('usr_password')) <p class="text-danger">{{$errors->first('usr_password')}}</p> @endif
        </div>
    </div>
    <div class="col-md-2 form-group @if($errors->has('usr_password_repeat')) has-error @endif">
        <label for="usr_password_repeat" class="label-control">Repita a senha*</label>
        <div class="controls">
            <input type="password" name="usr_password_repeat" class="form-control">
            @if($errors->has('usr_password_repeat')) <p class="text-danger">{{$errors->first('usr_password_repeat')}}</p> @endif
        </div>
    </div>
    @endif
</div>
<div class="row" style="margin-top: 20px">
    <div class="col-md-12 text-right">
        <button type="submit" class="btn btn-lg btn-success">Salvar</button>
    </div>
</div>