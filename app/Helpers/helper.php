<?php

if (!function_exists('selectRoute')) {

    function selectRoute($route) {
        return \Request::route()->getName() == $route ? 'active' : '';
    }

}

if (!function_exists('articles')) {

    function articles() {
        return \Cms\Articles\Repositories\ArticlesRepo::getInstance(new \Cms\Articles\Models\Articles());
    }

}

if (!function_exists('galleries')) {

    function galleries() {
        return \Cms\Galleries\Repositories\GalleriesRepo::getInstance(new \Cms\Galleries\Models\Galleries());
    }

}

if (!function_exists('sliders')) {

    function sliders() {
        return \Cms\Galleries\Repositories\SlidersRepo::getInstance(new \Cms\Galleries\Models\Sliders());
    }

}

if (!function_exists('news')) {

    function news() {
        return \Cms\News\Repositories\NewsRepo::getInstance(new \Cms\News\Models\News());
    }

}

if (!function_exists('modules')) {

    function modules() {
        return \App\Repositories\ModulesRepo::getInstance(new \App\Models\Modules());
    }

}
if (!function_exists('user')) {

    function user() {
        return \Cms\Roles\Repositories\UserRepo::getInstance(new \App\User());
    }

}
if (!function_exists('roles')) {

    function roles() {
        return \Cms\Roles\Repositories\RoleRepo::getInstance(new \Cms\Roles\Models\Roles());
    }

}
if (!function_exists('persons')) {

    function persons() {
        return \Cms\Persons\Repositories\PersonsRepo::getInstance(new \Cms\Persons\Models\Persons());
    }

}

if (!function_exists('files')) {

    function files($disc = 'public') {
        return Cms\Core\Repositories\FilesRepo::getInstance($disc);
    }

}

function fileInput($nameValue = 'default', $value = '', $class = [], $accept = array(), $size_crop = [], $del = true, $server = true, $required = false) {

    $e = explode('.', $value);
    $extensions = end($e);
    $crop = in_array($extensions, ['jpg', 'jpeg', 'png']);
    $accept = implode(',', $accept);

    return view('cms::includes.file', compact('nameValue', 'value', 'crop', 'class', 'accept', 'size_crop', 'del', 'server', 'required'));
}

function buttons($module = 'start') {

    return view('cms::includes.buttons', compact('module'));
}

if (!function_exists('selectRoute')) {

    function selectRoute($route, $active = 'active') {
        return request()->route()->getName() == $route ? $active : '';
    }

}

function selectMenu($elements, $active = 'active') {
    $open = false;
    list($prefix, ) = explode('.', request()->route()->getName());
    if (is_array($elements)) {
        foreach ($elements as $name => $element) {
            if ($prefix == $name) {
                $open = true;
            }
        }
    } else {
        return $prefix == $elements ? $active : '';
    }

    return $open ? $active : '';
}

/**
 * Generowanie widoku ckeditora
 * @param type $name
 * @param type $value
 * @param type $attribute
 * @return type
 */
function ckeditor($name, $value, $attribute = '') {
    return view('cms::includes.ckeditor', ['nameValue' => $name, 'value' => $value, 'attribute' => $attribute]);
}

function getImage($fileName, $fileSize = [], $disc = 'public') {

    if (!empty($fileName)) {
        $fileName = $fileName[0] != '/' ? '/' . $fileName : $fileName;
        $filePath = str_replace('/storage', '', $fileName);
        $fileCrop = str_replace('.', '_crop.', $filePath);
        $fileCropStoreage = str_replace('.', '_crop.', $fileName);

        if (!\Storage::disk($disc)->exists($fileCrop) && \Storage::disk($disc)->exists($filePath)) {
            return files($disc)->crop('.' . $fileName, $fileSize) ? url($fileCropStoreage) . '?' . time() : false;
        }

        return url($fileCropStoreage) . '?' . time();
    }
}

function cimage($img){
    return url(str_replace('.', '_crop.', $img));
}

function cropJavaScript($settings = []) {
    //return view('admin.helpers.cropJS', compact('settings'));
}

function getLang() {
    $tmp = \App\Models\Lang::select('code')->where('active', 1)->first();
    return $tmp ? $tmp->code : \Config::get('app.locale');
}

function getSettings() {
    $models = \App\Models\Settings::select('value', 'code')->where('lang', getLang())->orWhereNull('lang')->get();
    $settings = array();
    foreach ($models as $model) {
        $settings[$model->code] = $model->value;
    }
    return $settings;
}

if (!function_exists('seoUrl')) {

    function seoUrl($string, $prefix = '/') {
        $char_map = array(
            // Latin
            'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
            'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
            'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
            'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
            'ß' => 'ss',
            'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
            'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
            'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
            'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
            'ÿ' => 'y',
            // Latin symbols
            '©' => '(c)',
            // Greek
            'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
            'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
            'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
            'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
            'Ϋ' => 'Y',
            'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
            'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
            'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
            'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
            'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
            // Turkish
            'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
            'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',
            // Russian
            'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
            'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
            'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
            'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
            'Я' => 'Ya',
            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
            'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
            'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
            'я' => 'ya',
            // Ukrainian
            'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
            'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
            // Czech
            'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
            'Ž' => 'Z',
            'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
            'ž' => 'z',
            // Polish
            'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
            'Ż' => 'Z',
            'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
            'ż' => 'z',
            // Latvian
            'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
            'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
            'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
            'š' => 's', 'ū' => 'u', 'ž' => 'z'
        );
        $string = str_replace(array_keys($char_map), $char_map, $string);
        $string = str_replace(array('[\', \']'), '', $string);
        $string = preg_replace('/\[.*\]/U', '', $string);
        $string = preg_replace('/&(amp;)?#?[a-z0-9\/]+;/i', '-', $string);
        $string = htmlentities($string, ENT_COMPAT, 'utf-8');
        $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string);
        $string = preg_replace(array('/[^a-z0-9\/]/i', '/[-]+/'), '-', $string);
        $string = strtolower(trim($string, '-'));
        return (!isset($string[0]) || $string[0] != "/") ? $prefix . $string : $string;
    }

}