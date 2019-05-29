<?php

namespace Cms\Persons\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;

class PersonsController extends AdminController {

    public $path = 'persons::';
    public $name_module;

    public function __construct() {
        parent::__construct();

        $this->model = persons()->setLangs($this->langs);
        $this->name_module = $this->model->module_name;
    }

    public function index() {
        $this->title = 'Lista zgłoszeń';
        $rows = persons()->paginate();
        $countries = persons()->getCountry();
        $qualifications = persons()->getQualifications();

        return view($this->path . 'index', compact('rows', 'countries', 'qualifications'));
    }

    public function excel() {

        $this->title = 'Lista zgłoszeń';
        $rows = persons()->paginate();

        $filename = 'lista_zglosen' . time() . '.csv';
        $file = storage_path('/app/' . $filename);
        echo "\xEF\xBB\xBF";
        $fp = fopen($file, 'w');

        fputcsv($fp, [
            'ID',
            'Imie i nazwisko',
            'Data urodzenia',
            'Kwalifikacje',
            'Umiejętności',
            'Języki',
            'Oczekiwania finansowe',
            'Gotowośc do pracy',
            'Telefon',
            'Kraj pochodzenia',
            'Komentarz',
            'Data dodania',
            'Data edycji'
                ], ';');

        foreach ($rows as $fields) {
            fputcsv($fp, $fields->toArray(), ';');
        }

        fclose($fp);

        header('Content-Encoding: UTF-8');
        header('Content-type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        return \Storage::get($filename);
    }

}
