<?php
namespace App\Http\Controllers;

use App\Models\Swipe;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    private $posterBaseUrl;

    public function __construct()
    {
        $this->posterBaseUrl = env('POSTER_BASE_URL', 'https://image.tmdb.org/t/p/w500');
    }

    private function fetchMoviesFromApi(string $category)
    {
        $apiKey = env('TMDB_API_KEY');
        $baseUrl = env('TMDB_BASE_URL');
        $response = Http::get("{$baseUrl}movie/{$category}", [
            'api_key' => $apiKey,
            'language' => 'pt-BR',
        ]);
        if ($response->successful()) {
            return $response->json()['results'];
        }
        return []; 
    }

    private function getNextUnswipedMovie()
    {
        $user = Auth::user();
        $apiKey = env('TMDB_API_KEY');
        if (!$apiKey) {
            session()->flash('error', 'Chave TMDB API não configurada.');
            return null;
        }
        $swipedIds = Swipe::where('user_id', $user->id)->pluck('tmdb_movie_id')->toArray();
        $categories = [
            'popular',
            'top_rated',
            'now_playing',
        ];
        foreach ($categories as $category) {
            $movies = $this->fetchMoviesFromApi($category);
            foreach ($movies as $movie) {
                if (!in_array($movie['id'], $swipedIds)) {
                    return $movie; 
                }
            }
        }
        session()->flash('message', 'Você avaliou todos os filmes das principais categorias!');
        return null;
    }

    private function fetchAndCacheGenres()
    {
        $apiKey = env('TMDB_API_KEY');
        $baseUrl = env('TMDB_BASE_URL');
        return Cache::remember('tmdb_genres', 86400, function () use ($apiKey, $baseUrl) {
            $response = Http::get("{$baseUrl}genre/movie/list", [
                'api_key' => $apiKey,
                'language' => 'pt-BR',
            ]);
            if ($response->successful()) {
                return collect($response->json()['genres'])->pluck('name', 'id')->toArray();
            }
            return [];
        });
    }

    private function fetchMovieTrailer($tmdbMovieId)
    {
        $apiKey = env('TMDB_API_KEY');
        $baseUrl = env('TMDB_BASE_URL');
        $cacheDuration = 60 * 60 * 24;
        $cacheKey = 'tmdb_trailer_' . $tmdbMovieId;
        return Cache::remember($cacheKey, $cacheDuration, function () use ($tmdbMovieId, $apiKey, $baseUrl) {
            $response = Http::get("{$baseUrl}movie/{$tmdbMovieId}/videos", [
                'api_key' => $apiKey,
                'language' => 'pt-BR',
            ]);
            if ($response->successful()) {
                $videos = $response->json()['results'];
                $trailer = collect($videos)
                    ->where('type', 'Trailer')
                    ->where('site', 'YouTube')
                    ->first();
                return $trailer ? 'https://www.youtube.com/watch?v=' . $trailer['key'] : null;
            }
            return null;
        });
    }

    public function index()
    {
        return view('index');
    }

    public function home()
    {
        $nextMovie = $this->getNextUnswipedMovie();
        $genreMap = $this->fetchAndCacheGenres();
        if ($nextMovie && isset($nextMovie['genre_ids'])) {
            $genreNames = collect($nextMovie['genre_ids'])
                ->map(fn($id) => $genreMap[$id] ?? 'Desconhecido')
                ->implode(', ');
        } else {
            $genreNames = 'N/A';
        }
        $trailerUrl = $nextMovie ? $this->fetchMovieTrailer($nextMovie['id']) : null;
        return view('home', [
            'movie' => $nextMovie,
            'posterBaseUrl' => $this->posterBaseUrl,
            'genreNames' => $genreNames,
            'trailerUrl' => $trailerUrl
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