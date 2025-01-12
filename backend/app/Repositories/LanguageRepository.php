<?php

namespace App\Repositories;

use App\Models\Language;

class LanguageRepository
{
    public function getActiveLanguages()
    {
        return Language::where('status','1')
            ->orderBy('language_name','asc')
            ->select('id','language_name')
            ->get();
    }
}