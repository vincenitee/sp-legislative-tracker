<?php

namespace App\Http\Controllers;

use App\Models\Ordinance;
use App\Models\Resolution;
use Illuminate\Http\Request;

class PublicSearchController extends Controller
{
    public function index(Request $request){
        $keyword = trim((string) $request->input('keyword', ''));
        $type = $request->input('type', 'all');
        $number = trim((string) $request->input('number', ''));

        $ordinances = collect();
        $resolutions = collect();

        if($type == 'all' || $type == 'ordinance') {
            $ordQuery = Ordinance::query();

            if($keyword !== '') {
                $ordQuery->where('title', 'like', '%' . $keyword . '%');
            }

            if($number !== '') {
                $ordQuery->where('ordinance_number', 'like', '%' . $number . '%');
            }

            $ordinances = $ordQuery->orderByDesc('date_passed')->get()->map(function (Ordinance $item) {
                return [
                    'id' => $item->id,
                    'record_type' => 'Ordinance',
                    'number' => $item->ordinance_number,
                    'title' => $item->title,
                    'date_passed' => $item->date_passed,
                    'author_sponsor' => $item->author_sponsor,
                    'status' => $item->status,
                    'url' => route('public.ordinance.show', $item),
                ];
            });
        }

        if($type == 'all' || $type == 'resolution') {
            $resQuery = Resolution::query();

            if($keyword !== '') {
                $resQuery->where('title', 'like', '%'. $keyword .'%');
            }

            if($number !== '') {
                $resQuery->where('resolution_number', 'like', '%' . $number . '%');
            }

            $resolutions = $resQuery->orderByDesc('date_passed')->get()->map(function (Resolution $item) {
                return [
                    'id' => $item->id,
                    'record_type' => 'Resolution',
                    'number' => $item->resolution_number,
                    'title' => $item->title,
                    'date_passed' => $item->date_passed,
                    'author_sponsor' => $item->author_sponsor,
                    'status' => $item->status,
                    'url' => route('public.resolution.show', $item),
                ];
            });
        }

        $results = $ordinances
            ->concat($resolutions)
            ->sortByDesc(fn ($item) => $item['date_passed']->format('Y-m-d'))
            ->values();

        return view('public.search', compact('results', 'keyword', 'type', 'number'));
    }  
    
    public function showOrdinance(Ordinance $ordinance){
        return view('public.show-ordinance', compact('ordinance'));
    }

    public function showResolution(Resolution $resolution) {
        return view('public.show-resolution', compact('resolution'));
    }
}
