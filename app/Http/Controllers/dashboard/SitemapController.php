<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sites;

class SitemapController extends Controller
{
    public function generatorSitemap($value=''){
        $sites = Sites::select('title', 'created_at')->get();
        
        return response()->view('sitemap', [
            'sites' => $sites,
        ])->header('Content-Type', 'text/xml');
    }
    
}
