<?php
namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class CharacterController extends Controller{
    private function fetchCharacters(){
        return Cache::remember('characters_api', now()->addHours(6), function () {
            $all = [];
            for ($page = 1; $page <= 5; $page++) {
                $resp = Http::get('https://rickandmortyapi.com/api/character', ['page' => $page]);
                $all = array_merge($all, $resp->json('results') ?? []);
            }
            return $all;
        });
    }

    public function store(Request $request){
        $characters = $this->fetchCharacters();

        foreach ($characters as $c) {
            Character::updateOrCreate(
                [ 'api_id' => $c['id'] ],
                [
                    'name'        => $c['name'],
                    'status'      => $c['status'],
                    'species'     => $c['species'],
                    'type'        => $c['type'],
                    'gender'      => $c['gender'],
                    'origin_name' => $c['origin']['name'],
                    'origin_url'  => $c['origin']['url'],
                    'image_url'   => $c['image'],
                ]
            );
        }

        return redirect()->route('characters.db')
               ->with('success', 'Datos Guardados');
    }

    public function index(){
        if (Character::exists()) {
            $characters = Character::all();
            return view('characters.db', compact('characters'));
        }

        $characters = $this->fetchCharacters();
        return view('characters.index', compact('characters'));
    }

    public function db(){
        $characters = Character::all();
        return view('characters.db', compact('characters'));
    }

    public function edit(Character $character){
        return view('characters.edit', compact('character'));
    }

    public function update(Request $r, Character $character){
        $character->update($r->only([
            'name','status','species','type','gender',
            'origin_name','origin_url','image_url'
        ]));

        return redirect()->route('characters.db')
               ->with('success', 'Datos Actualizados');
    }
}
