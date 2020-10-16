<?php

namespace App\Http\Controllers\Shortener;

use App\Http\Controllers\Controller;
use App\Models\ShortUrl;
use App\Services\Math;
use App\Singletons\ShortenerAuth;
use Illuminate\Http\Request;

class ShortenerController extends Controller
{

    public function index()
    {
        return response()->json(ShortUrl::where('user_id', ShortenerAuth::user()->id)->get());
    }

    public function createShortUrl(Request $request)
    {
        $rules = [
            "url" => "required"
        ];

        $this->validate($request, $rules);

        $shortUrl = ShortUrl::create([
            "url" => $request->url,
            "short_url" => Math::generateCode(),
            "user_id" => ShortenerAuth::user()->id
        ]);

        return response()->json($shortUrl);
    }

    public function redirectUrl($id)
    {
        $shortUrl = ShortUrl::where('short_url', $id)->first();

        if($shortUrl) {
            return redirect($shortUrl->url);
        }

        return view('errors.404');
    }
}
