<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;

class LanguageController extends Controller
{
    public function setLanguage(Request $request)
    {
        session(['lang' => $request->lang]);
        return back();
    }

    public static function t($text)
    {
        $lang = session('lang', 'id'); // default 'id'
        if ($lang === 'id') return $text;

        try {
            $tr = new GoogleTranslate($lang);
            return $tr->translate($text);
        } catch (\Exception $e) {
            return $text; // fallback jika gagal
        }
    }
}