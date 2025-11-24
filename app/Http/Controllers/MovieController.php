<?php
namespace App\Http\Controllers;

use App\Models\Swipe;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    private $posterBaseUrl;

    public function __construct()
    {
        $this->posterBaseUrl = env('POSTER_BASE_URL', 'https://image.tmdb.org/t/p/w500');
    }

    private function getNextUnswipedMovie()
    {
        $user = Auth::user();
        $apiKey = env('TMDB_API_KEY');
        $baseUrl = env('TMDB_BASE_URL');
        if (!$apiKey) {
            session()->flash('error', 'Chave TMDB API não configurada.');
            return null;
        }
        $swipedIds = Swipe::where('user_id', $user->id)->pluck('tmdb_movie_id')->toArray();
        $response = Http::get("{$baseUrl}movie/popular", [
            'api_key' => $apiKey,
            'language' => 'pt-BR'
        ]);
        if (!$response->successful()) {
            session()->flash('error', 'Erro ao consumir a API do TMDB.');
            return null;
        }
        $movies = $response->json()['results'];
        foreach ($movies as $movie) {
            if (!in_array($movie['id'], $swipedIds)) {
                return $movie; 
            }
        }
        return null;
    }

    public function index()
    {
        $nextMovie = $this->getNextUnswipedMovie();
        return view('home', [
            'movie' => $nextMovie,
            'posterBaseUrl' => $this->posterBaseUrl,
        ]);
    }
    
    public function storeSwipe(Request $request)
    {
        $request->validate([
            'tmdb_movie_id' => 'required|integer',
            'type' => 'required|in:like,dislike',
        ]);
        $user = Auth::user();
        $swipe = new Swipe([
            'tmdb_movie_id' => $request->tmdb_movie_id,
            'type' => $request->type,
        ]);
        $swipe->user_id = $user->id;
        $swipe->save();
        return redirect()->route('home');
    }
}