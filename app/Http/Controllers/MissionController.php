<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Http\Controllers\Controller;
use App\Resources\Mission\Mission as MissionResource;
use App\Models\User ;
use Carbon\Carbon;
use Illuminate\Http\Request;
use stdClass;
use function Webmozart\Assert\Tests\StaticAnalysis\length;
use App\Resources\User\User as UserResource;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        return MissionResource::collection(Mission::orderBy('id', 'ASC')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createOrUpdate(Request $request)
    {
        $points = $this->calcPoints($request);
        $mission = Mission::updateOrCreate(
            ['id' => $request->id],
            [
                'id_utente' => $request->idUtente,
                'parola_cruciverba' => $request->parolaCruciverba,
                'selfie_festeggiato' => $request->selfieFesteggiato,
                'selfie_angolo' => $request->selfieAngolo,
                'brindisi' => $request->brindisi,
                'video_brindisi' => $request->videoBrindisi,
                'dedica' => $request->dedica,
                'indovinello' => $request->indovinello,
                'indovinello_due' => $request->indovinelloDue,
                'punteggio' => $points,
                'date' => Carbon::now()
            ]
        );
        User::where('id', $request->idUtente)->update(['punteggio' => $points]);
        $user = User::where('id', $request->idUtente)->first();
        $user['mission'] = $mission;
        return response()->json(['data' => new UserResource($user)], 200);
    }

    public function calcPoints(Request $request) {
        $points = 0;
        if(strtolower($request->parolaCruciverba) == 'arcobaleno') {
            $points = $points + 20;
        }

        if($request->selfieFesteggiato != null) {
            $points = $points + 25;
        }

        if($request->selfieAngolo != null) {
            $points = $points + 25;
        }

        if($request->videoBrindisi != null) {
            $points = $points + 30;
        }

        if($request->dedica != null && $request->dedica != '') {
            $points = $points + 20;
        }

        if(strtolower($request->indovinello) == 'campagna') {
            $points = $points + 20;
        }

        if(strtolower($request->indovinelloDue) == '5102005') {
            $points = $points + 20;
        }

        return $points;
    }

    public function getByIdUser($id)
    {
        return new MissionResource(Mission::where('id_utente', $id));
    }

    public function delete($id)
    {
        $product = Mission::where('id', $id)->first();
        return $product->delete();
    }
}
