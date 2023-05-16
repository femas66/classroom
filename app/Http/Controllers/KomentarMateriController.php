<?php

namespace App\Http\Controllers;

use App\Models\MateriKomentar;
use Illuminate\Http\Request;

class KomentarMateriController extends Controller
{
    function delete($id) {
        $materi = MateriKomentar::find($id);
        $materi->delete();
        return back();
    }
}
