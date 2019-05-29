@extends('cms::index') 
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-default">
            <div class="card-header  separator">
                <div class="card-title">
                    Użytkownicy
                </div>
            </div>
            <div class="card-body">
                <div>
                    <?= Form::open(['method' => 'GET']); ?>
                    <div class="row">
                        <?php if ($countries): ?>
                            <div class="col-sm-4 col-12">
                                <div class="form-group">
                                    <label for=""> Kraj</label>
                                    <select name="country" id="" class="form-control">
                                        <option>--wybierz--</option>
                                        <?php foreach ($countries as $country): ?>
                                            <?php if (!empty($country->country)): ?>
                                                <option <?= request()->get('country') == $country->country ? 'selected="selected"' : ''; ?>><?= $country->country; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($qualifications): ?>
                            <div class="col-sm-4 col-12">
                                <div class="form-group">
                                    <label for="">Kwalifikacje/zawód</label>
                                    <select name="qualifications" id="" class="form-control">
                                        <option>--wybierz--</option>
                                        <?php foreach ($qualifications as $qualification): ?>
                                            <?php if (!empty($qualification->qualifications)): ?>
                                                <option <?= request()->get('qualifications') == $qualification->qualifications ? 'selected="selected"' : ''; ?>><?= $qualification->qualifications; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="col-sm-4 col-12">

                            <div class="form-group">
                                <a href="<?=route('persons.excel',request()->all());?>" class="btn btn-xs btn-outline-dark w-100 mb-2">drukuj excel</a>
                                <button type="sumbit" class="btn btn-xs btn-primary w-100">szukaj</button>
                            </div>
                        </div>
                    </div>
                    <?= Form::close(); ?>
                </div>


                <div class="table-responsive">
                    <div id="basicTable_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-hover dataTable no-footer" id="basicTable" role="grid">
                            <thead>
                                <tr>
                                    <th width="30px">#</th>
                                    <th scope="col">Nazwa</th>
                                    <th scope="col">Zawód</th>
                                    <th scope="col">telefon</th>
                                    <th scope="col">kraj poch.</th>
                                    <th class="text-right" scope="col">opcje</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($rows)): ?>
                                    <?php foreach ($rows as $row): ?>
                                        <tr>
                                            <td>
                                                <?= $row->id; ?>
                                            </td>
                                            <td>
                                                <?= $row->name ?? 'brak'; ?>
                                            </td>
                                            <td>
                                                <?= $row->qualifications ?? 'brak'; ?>
                                            </td>
                                            <td>

                                                <?= $row->phone ?? 'brak'; ?>
                                            </td>
                                            <td>

                                                <?= $row->country ?? 'brak'; ?>
                                            </td>
                                            <td class="text-right">

                                                <button class="btn btn-xs btn-outline-dark" onclick="showPerson('<?= htmlentities($row->toJson()); ?>')">zobacz</button>
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
    <div class="col-12 my-3">
        <?php if (isset($rows)): ?>
            <?= $rows->links(); ?>
        <?php endif; ?>
    </div>
    <div class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Zgłoszone dane</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    var data = {
	id: 'Nr zgłószenia',
	name: 'Imię i nazwisko',
	bdate: 'data urodzenia',
	qualifications: 'kwalifikacje',
	skills: 'umiejętności',
	langs: 'języki',
	paymants: 'wymagania finansowe',
	sdate: 'data gotowości',
	phone: 'telefon',
	country: 'kraj pochodzenia',
	comments: 'komentarz',
	created_at: 'data zgłoszenia',
	updated_at: ''
    }


    function showPerson(person) {
	var row = JSON.parse(person);
	var ul = document.createElement('ul');

	for (var i in row) {
	    if (i != 'updated_at') {
		var li = document.createElement('li')
		li.innerHTML = data[i] + ': ' + row[i]
		ul.appendChild(li)
	    }
	}

	$('.modal-body').html(ul)
	$('.modal').modal('show')

    }

</script>
@endsection

