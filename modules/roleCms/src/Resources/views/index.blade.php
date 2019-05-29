@extends('cms::index') 
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-default">
            <div class="card-header separator">
                <div class="card-title">Nowy użytkownik</div>
            </div>
            <div class="card-body pt-3">
                <?= Form::open(['route' => 'user.create', 'class' => 'my-3']); ?>
                <div class="form-group">
                    <label>Podaj nazwe </label>
                    <?= Form::text('name', old('name'), ['class' => 'form-control', 'required' => 'required']); ?>
                </div>
                <div class="form-group">
                    <label>Podaj email</label>
                    <?= Form::email('email', old('email'), ['class' => 'form-control', 'required' => 'required']); ?>
                </div>
                <?php if (isset($new_user)): ?>
                    <div class="form-group alert alert-success">
                        email: <?= $new_user->email??''; ?></br>
                        hasło: <?= $new_user->haslo??''; ?>
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <label>Rola użytkownika</label>
                    <select name="roles_id" id="" class="form-control">
                        <?php if ($roles): ?>
                            <?php foreach ($roles as $role): ?>
                                <option value="<?= $role->id; ?>"><?= $role->name; ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Dodaj</button>
                <?= Form::close(); ?>
            </div> 
        </div>
    </div>
    <div class="col-12">
        <div class="card card-default">
            <div class="card-header separator">
                <div class="card-title">Dodaj nową role</div>
            </div>
            <div class="card-body pt-3">
                <?= Form::open(['route' => 'roles.create', 'class' => 'my-3']); ?>
                <div class="form-group">
                    <label>Podaj nazwe </label>
                    <?= Form::text('name', old('name'), ['class' => 'form-control', 'required' => 'required']); ?>
                </div>
                <button type="submit" class="btn btn-primary">Dodaj</button>
                <?= Form::close(); ?>
            </div> 
        </div>
    </div>
    <div class="col-12">

        <div class="card card-default">
            <div class="card-header  separator">
                <div class="card-title">
                    Użytkownicy
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="basicTable_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-hover dataTable no-footer" id="basicTable" role="grid">
                            <thead>
                                <tr>
                                    <th width="30px">#</th>
                                    <th scope="col">Nazwa</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Rola</th>
                                    <th scope="col">Opcje</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($users)): ?>
                                    <?php foreach ($users as $user): ?>
                                        <tr>
                                            <td>
                                                <?= $user->id; ?>
                                            </td>
                                            <td>
                                                <input type="text" class="user-name form-control"  value="<?= $user->name; ?>">
                                            </td>
                                            <td>
                                                <input type="text" class="user-email form-control" value="<?= $user->email; ?>">
                                            </td>
                                            <td class="role-name">

                                                <?php $user_role = $user->role->name; ?>
                                                <select name="roleUser" id="" class="form-control">
                                                    <?php foreach ($roles as $role): ?>

                                                        <option value="<?= $role->id; ?>" <?= ($role->name == $user_role) ? 'selected="selected"' : '' ?>><?= $role->name; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                            <td class="text-right">

                                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                                    <?php if (\Auth::user()->can('user.update')): ?>

                                                        <button class="btn-xs btn btn-outline-dark" data-id="<?= $user->id; ?>" onclick="editUser(event)">Zapisz zmiany</button>

                                                        <div class="btn-group d-block" role="group">
                                                            <button id="btnGroupDrop1" type="button" class="btn btn-outline-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                                <?php if ($user->roles != 1): ?>
                                                                    <a href="<?= route('user.delete', ['id' => $user->id]); ?>" class="dropdown-item" onclick="return confirm('Napewno usunać strone?')">Usuń</a>
                                                                <?php endif; ?>
                                                                <a href="<?= route('user.reset', ['id' => $user->id]); ?>" class=" dropdown-item" onclick="return confirm('Napewno resetowac hasło?')">Resetuj hasło</a>
                                                            </div>
                                                        </div>

                                                    <?php endif; ?>
                                                </div>



                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mb-3">
        <div class="card card-default">
            <div class="card-header  separator">
                <div class="card-title">
                    Edytuj role
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="basicTable_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-hover dataTable no-footer" id="basicTable" role="grid">
                            <thead>
                                <tr>
                                    <th width="30px">#</th>
                                    <th scope="col">Nazwa</th>

                                    <th scope="col">Opcje</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($roles as $role): ?>
                                    <tr>
                                        <td><?= $role->id; ?></td>
                                        <td><?= $role->name; ?></td>
                                        <td>
                                            <a href="<?= route('roles.read', ['id' => $role->id]); ?>" class="btn-default btn pull-right">Edytuj</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {

	$("#checkbox").click(function () {
	    if ($("#checkbox").is(':checked')) {
		$(".modules > option").prop("selected", "selected");
		$(".modules").trigger("change");
	    } else {
		$(".modules > option").removeAttr("selected");
		$(".modules").trigger("change");
	    }
	});
    });

    function editUser(event) {
	var $name = event.target.closest('tr').querySelector('.user-name');
	var $email = event.target.closest('tr').querySelector('.user-email');
	var $id = event.target.getAttribute('data-id');
	var $rola = event.target.closest('tr').querySelector('[name="roleUser"]');

	if ($name.value == '' || $email.value == '') {
	    ALERTS.show({type: 'danger', message: ['Wypełnij wszystkie pola']});
	} else {
	    queryAjax('<?= route('user.update'); ?>',
		    {id: $id, name: $name.value, email: $email.value, roles: $rola.value},
		    function (json) {
			if (json.errors.length) {
			    ALERTS.show({type: 'danger', message: json.errors});
			} else {
			    ALERTS.show({type: 'success', message: json.success});
			}
		    }, 'POST');
	}
    }
    function changehref(e) {
	e.preventDefault();
	e.target.href += '/' + document.querySelector('[name="roleUser"]').value;
	console.log(e.target.href);
	window.location = e.target.href;
    }
</script>
@endsection

