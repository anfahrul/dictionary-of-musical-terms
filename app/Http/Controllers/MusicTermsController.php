<?php

namespace App\Http\Controllers;

use App\Models\MusicTerms;
use App\Http\Requests\StoreMusicTermsRequest;
use App\Http\Requests\UpdateMusicTermsRequest;
use Illuminate\Http\Request;
use DB;

class MusicTermsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $musicTerms = MusicTerms::orderBy('title', 'asc')->get();

        return view('admin.istilah.index', [
            'title' => 'Istilah',
            'musicTerms' => $musicTerms
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.istilah.create', [
            'title' => 'Tambah Data',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $termData =  $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $termData['description'] = strip_tags($request->description);

        MusicTerms::create($termData);

        return redirect('/admin/terms')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(MusicTerms $musicTerms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MusicTerms $musicTerms, $term)
    {
        $term = MusicTerms::find($term);

        return view('admin.istilah.edit', [
            'title' => 'Edit Data',
            'term' => $term
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MusicTerms $musicTerms, $term)
    {
        $termData =  $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $termData['description'] = strip_tags($request->description);

        MusicTerms::where('id', $term)
            ->update($termData);

        return redirect('/admin/terms')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MusicTerms $musicTerms, $term)
    {
        $term = MusicTerms::findOrFail($term);

        $term->delete();

        return redirect('/admin/terms')->with('success', 'Data berhasil dihapus');
    }


    public function indexAPI()
    {
        $musicTerms = MusicTerms::orderBy('title', 'asc')->get();

        return response()->json(['status' => 'success', 'data' => $musicTerms]);
    }

    public function showAPI(MusicTerms $musicTerms, $id)
    {
        $music = MusicTerms::find($id);

        if(!$music){
            return response()->json(['status'=> 'failed','message'=> 'Data tidak ditemukan!']);
        }
        return response()->json(['status' => 'success', 'data' => $music]);
    }

    public function searchAPI(Request $request)
    {
        $searchInput = $request->input("search");
        $musicData = MusicTerms::all();
        $threshold = 3;

        $result = [];
        $searchResultMode = "";
        foreach ($musicData as $data) {
            $matches = $this->KMPSearch(strtolower($searchInput), strtolower($data->title));
            if (count($matches) > 0) {
                $result[] = $data;
                $searchResultMode = "Normal";
            }
        }

        if (empty($result)) {
            $similarityData = array();

            foreach ($musicData as $data) {
                $distance = $this->levenshteinSearch(strtolower($searchInput), strtolower($data->title));
                $maxLength = max(strlen($searchInput), strlen($data->title));

                $similarity = (1 - $distance / $maxLength) * 100;

                // Menyimpan kesamaan yang lebih dari 50% ke dalam array
                if ($similarity >=60) {
                    $result[] = array("id" => $data->id, "nearestString" => $data->title, "description" => $data->description, "similarity" => $similarity);
                    $searchResultMode = "Nearest";
                }
            }
        }

        if ($searchResultMode === "Normal") {
            usort($result, function($a, $b) {
                return strcmp($a['title'], $b['title']);
            });
        } else {
            usort($result, function($a, $b) {
                return strcmp($b['similarity'], $a['similarity']);
            });
        };


        return response()->json([
            "status" => "success",
            "search_result_mode" => $searchResultMode,
            "data" => $result
        ]);
    }

    public function levenshteinSearch($pattern, $text)
    {
        $patternLength = strlen($pattern);
        $textLength = strlen($text);

        // Inisialisasi matriks
        $dp = [];
        for ($i = 0; $i <= $patternLength; $i++) {
            $dp[$i][0] = $i;
        }
        for ($j = 0; $j <= $textLength; $j++) {
            $dp[0][$j] = $j;
        }

        // Menghitung jarak Levenshtein
        for ($i = 1; $i <= $patternLength; $i++) {
            for ($j = 1; $j <= $textLength; $j++) {
                $cost = ($pattern[$i - 1] != $text[$j - 1]) ? 1 : 0;
                $dp[$i][$j] = min(
                    $dp[$i - 1][$j] + 1,
                    $dp[$i][$j - 1] + 1,
                    $dp[$i - 1][$j - 1] + $cost
                );
            }
        }

        // Mengembalikan jarak Levenshtein antara pattern dan text
        return $dp[$patternLength][$textLength];
    }

    private function computeLPSArray($pat, &$lps)
    {
        $len = 0;
        $i = 1;
        $lps[0] = 0;

        while ($i < strlen($pat)) {
            if ($pat[$i] == $pat[$len]) {
                $len++;
                $lps[$i] = $len;
                $i++;
            } else {
                if ($len != 0) {
                    $len = $lps[$len - 1];
                } else {
                    $lps[$i] = 0;
                    $i++;
                }
            }
        }
    }

    private function KMPSearch($pat, $txt)
    {
        $m = strlen($pat);
        $n = strlen($txt);

        $lps = [];
        $this->computeLPSArray($pat, $lps);

        $i = $j = 0;
        $matches = [];

        while ($i < $n) {
            if ($pat[$j] == $txt[$i]) {
                $i++;
                $j++;
            }

            if ($j == $m) {
                $matches[] = $i - $j;
                $j = $lps[$j - 1];
            } elseif ($i < $n && $pat[$j] != $txt[$i]) {
                if ($j != 0) {
                    $j = $lps[$j - 1];
                } else {
                    $i++;
                }
            }
        }

        return $matches;
    }
}
