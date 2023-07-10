<?php

namespace App\Http\Controllers;

use App\Models\Fleet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FleetController extends Controller
{
    public function getFleetData(Request $request)
    {
        $fleet = Fleet::find($request->id);
        return response()->json($fleet);
    }

    public function getUserFleetLocation(Request $request)
    {
        $fleetsArray = Fleet::where('user_id', $request->user_id)->get()->toArray();

        foreach ($fleetsArray as $fleet) {

            $location = DB::select('SELECT lat, lng, fleet_id
                                    FROM locations 
                                    WHERE fleet_id = ? 
                                    ORDER BY id DESC 
                                    LIMIT 1', [$fleet['id']]);

            // $location = Location::select('lat','lng')
            //     ->where('fleet_id', $fleet['id'])
            //     ->orderBy('id', 'desc')
            //     ->limit(1)
            //     ->get()
            //     ->toArray();

            $fleetReeturn[] = $location;
        }

        return array_map('current', $fleetReeturn);
    }


    public function getUserFleets(Request $request)
    {
        return Fleet::where('user_id', $request->user_id)->get();
    }

    
    public function getUserFleetLocationBetter(Request $request)
    {
        $fleetsArray = Fleet::select('id')->where('user_id', $request->user_id)->get()->toArray();

        $fleetId = '';

        foreach ($fleetsArray as $fleet)
            $fleetId .= "{$fleet['id']},";

        $fleetId = substr($fleetId, 0, -1);

        $location = DB::select("SELECT t1.lat, t1.lng, t1.fleet_id
        FROM locations AS t1
        JOIN (
            SELECT fleet_id, MAX(id) AS ultimo_registro
            FROM locations
            WHERE fleet_id IN ({$fleetId})
            GROUP BY fleet_id
        ) AS t2
        ON t1.fleet_id = t2.fleet_id AND t1.id = t2.ultimo_registro;");

        return $location;
    }
}
