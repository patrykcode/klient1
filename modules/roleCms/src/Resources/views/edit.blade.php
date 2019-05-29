@extends('cms::index') 
@section('content')
<div class="row">
    <div class="col-12">
        <?= Form::open(['route' => ['roles.update'], 'class' => 'my-3', 'enctype' => 'multipart/form-data']); ?>
        <div class="card card-default">
            <div class="card-header separator">
                <div class="card-title">Uprawnienia roli</div>
                <?=buttons('user');?>
            </div>
            <div class="card-body pt-3">
                <div class="form-group">
                    <label for="">Edytuj nazwe roli</label>
                    <?= Form::text('name', old('name') != '' ? old('name') : $role->name, ['class' => 'form-control', 'required' => 'required']); ?>
                    <?= Form::hidden('id', $role->id, ['required' => 'required']); ?>
                </div>
                <div class="form-group">
                    <label for="">Edytuj uprawnienia </label>
                    <div class="form-group row">
                        <?php foreach (config('rolecms.abilities') as $name => $premission): ?> 
                            <div class="col-sm-3 col-12">
                                <label class="col-12"><?= $name; ?> </label>
                                <?php foreach ($premission as $value): ?> 
                                    <div class="checkbox  check-success">
                                        <?php $action = $name . '.' . $value; ?>
                                        <input type="checkbox" name="premissions[<?= $name; ?>][<?= $value; ?>]" id="premissions<?= $name; ?><?= $value; ?>" 
                                               <?=
                                               $premissions->filter(function($r) use($action) {
                                                   return $r->action == $action;
                                               })->first() ? 'checked="checked"' : ''
                                               ?>/>
                                        <label for="premissions<?= $name; ?><?= $value; ?>" class=""> <?= $name; ?>-<?= $value; ?> </label>

                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?= Form::close(); ?>
        </div>
    </div>
</div>
@endsection

