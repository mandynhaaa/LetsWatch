<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Swipe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class GroupController extends Controller
{
    public function create()
    {
        return view('groups.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $user = Auth::user();
        $group = Group::create([
            'name' => $validated['name'],
            'created_by_user_id' => $user->id,
            'invite_code' => Str::random(8),
        ]);
        $group->members()->attach($user->id);
        return redirect()->route('groups.show', $group)->with('success', 'Grupo criado com sucesso!');
    }
    
    public function join(Request $request)
    {
        $request->validate([
            'code' => 'required|string|exists:groups,invite_code',
        ], [
            'code.exists' => 'O código de convite fornecido é inválido. Por favor, verifique e tente novamente.',
        ]);
        $group = Group::where('invite_code', $request->code)->first();
        $user = Auth::user();
        if ($group->members()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'Você já é membro deste grupo.');
        }
        $group->members()->attach($user->id);
        return redirect()->route('groups.show', $group)->with('success', 'Você entrou no grupo com sucesso!');
    }
    
    public function show(Group $group)
    {
        if (!$group->members->contains(Auth::id())) {
            abort(403, 'Acesso Negado.');
        }
        $memberCount = $group->members()->count();
        $likedMoviesTmdbIds = Swipe::select('tmdb_movie_id')
            ->whereIn('user_id', $group->members->pluck('id'))
            ->where('type', 'like')
            ->groupBy('tmdb_movie_id')
            ->havingRaw('COUNT(tmdb_movie_id) = ?', [$memberCount])
            ->pluck('tmdb_movie_id')
            ->toArray();
        $moviesDetails = [];
        $apiKey = env('TMDB_API_KEY');
        $baseUrl = env('TMDB_BASE_URL');
        $cacheDuration = 60 * 60 * 24;
        $posterBaseUrl = env('POSTER_BASE_URL', 'https://image.tmdb.org/t/p/w500'); 
        foreach ($likedMoviesTmdbIds as $tmdbId) {
            $cacheKey = 'tmdb_movie_' . $tmdbId;
            $movieData = Cache::remember($cacheKey, $cacheDuration, function () use ($tmdbId, $apiKey, $baseUrl) {
                $response = Http::get("{$baseUrl}movie/{$tmdbId}", [
                    'api_key' => $apiKey,
                    'language' => 'pt-BR',
                ]);
                if ($response->successful()) {
                    return $response->json();
                }
                return null;
            });
            if ($movieData) {
                $moviesDetails[] = [
                    'id' => $movieData['id'],
                    'title' => $movieData['title'],
                    'poster_path' => $posterBaseUrl . $movieData['poster_path'],
                    'vote_average' => number_format($movieData['vote_average'], 1),
                    'release_date' => isset($movieData['release_date']) && $movieData['release_date'] !== 'N/A' 
                        ? \Carbon\Carbon::parse($movieData['release_date'])->format('d/m/Y') 
                        : 'N/A',
                ];
            }
        }
        return view('groups.show', compact('group', 'moviesDetails'));
    }

    public function showFeedbackForm(Group $group, $tmdbMovieId)
    {
        if (!$group->members->contains(Auth::id())) {
            abort(403, 'Acesso Negado.');
        }
        $apiKey = env('TMDB_API_KEY');
        $baseUrl = env('TMDB_BASE_URL');
        $posterBaseUrl = env('POSTER_BASE_URL', 'https://image.tmdb.org/t/p/w500');
        $cacheKey = 'tmdb_movie_' . $tmdbMovieId;
        $movieData = Cache::remember($cacheKey, 86400, function () use ($tmdbMovieId, $apiKey, $baseUrl) {
            $response = Http::get("{$baseUrl}movie/{$tmdbMovieId}", ['api_key' => $apiKey, 'language' => 'pt-BR']);
            return $response->successful() ? $response->json() : null;
        });
        if (!$movieData) {
            return back()->with('error', 'Filme não encontrado ou API indisponível.');
        }
        $existingFeedback = \App\Models\MovieSession::where('group_id', $group->id)
                                                  ->where('tmdb_movie_id', $tmdbMovieId)
                                                  ->first();
        $movieDetails = [
            'id' => $movieData['id'],
            'title' => $movieData['title'],
            'poster_path' => $posterBaseUrl . $movieData['poster_path'],
        ];
        return view('groups.feedback', compact('group', 'movieDetails', 'existingFeedback'));
    }

    public function storeFeedback(Request $request, Group $group, $tmdbMovieId)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:10',
            'comment' => 'nullable|string|max:1000',
        ]);
        if (!$group->members->contains(Auth::id())) {
            abort(403, 'Acesso Negado.');
        }
        \App\Models\MovieSession::updateOrCreate(
            [
                'group_id' => $group->id,
                'tmdb_movie_id' => $tmdbMovieId,
            ],
            [
                'rating' => $validated['rating'],
                'comment' => $validated['comment'],
            ]
        );
        return redirect()->route('groups.show', $group)->with('success', 'Feedback salvo com sucesso!');
    }
}
