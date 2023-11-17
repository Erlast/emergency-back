<?php
namespace App\Http\Controllers;

use App\Models\MisDoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdmController extends Controller {
    public function admpage () {
        return(view("adm"));
    }

public function translit($value)
{
    $converter = array(
	'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
	'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
	'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
	'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
	'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
	'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
	'э' => 'e',    'ю' => 'yu',   'я' => 'ya',
 
	'А' => 'A',    'Б' => 'B',    'В' => 'V',    'Г' => 'G',    'Д' => 'D',
	'Е' => 'E',    'Ё' => 'E',    'Ж' => 'Zh',   'З' => 'Z',    'И' => 'I',
	'Й' => 'Y',    'К' => 'K',    'Л' => 'L',    'М' => 'M',    'Н' => 'N',
	'О' => 'O',    'П' => 'P',    'Р' => 'R',    'С' => 'S',    'Т' => 'T',
	'У' => 'U',    'Ф' => 'F',    'Х' => 'H',    'Ц' => 'C',    'Ч' => 'Ch',
	'Ш' => 'Sh',   'Щ' => 'Sch',  'Ь' => '',     'Ы' => 'Y',    'Ъ' => '',
	'Э' => 'E',    'Ю' => 'Yu',   'Я' => 'Ya',   ' ' => '_'
    );
 
    $value = strtr($value, $converter);
    return $value;
}

    public function app_data (Request $form_data) {

        $vol = $form_data->get('vol');
        $str = $form_data->get('rowtitle');
        $file = $form_data->file('uplfile');
	$codeFname = AdmController::translit($file->getClientOriginalName());
//	phpinfo();
//	die('ok');
        $path = $form_data->file('uplfile')->storeAs('public/'.$vol, $codeFname);
        $sitepath = Storage::get($path);
        $mdb = new MisDoc();
        $mdb->name=$str;
        $mdb->doc='/storage/'.$vol.'/'.$codeFname;
        $mdb->razdel=$vol;
        $mdb->save();
    }

}

