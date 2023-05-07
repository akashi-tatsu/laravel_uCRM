<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\IntertiaTest;

class InertiaTestController extends Controller
{
    public function index()
    {
        return Inertia::render('Inertia/index',[
            'blogs' => IntertiaTest::all()
        ]);
    }

    public function create()
    {
        return Inertia::render('Inertia/Create');
    }

    public function show($id)
    {
        return Inertia::render('Inertia/Show',
    [
        'id' => $id,
        'blog' => IntertiaTest::findOrFail($id)
    ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:20'],
            'content' => ['required'],
        ]);

        $inertiaTest = new IntertiaTest;
        $inertiaTest->title = $request->title;
        $inertiaTest->content = $request->content;
        $inertiaTest->save();

        return to_route('inertia.index')
        ->with([
            'message' => '登録しました'
        ]);
    }

    public function delete($id)
    {
        $book = IntertiaTest::findOrFail($id);
        $book ->delete();

        return to_route('inertia.index')
        ->with([
            'message' => '削除しました'
        ]);
    }
}
