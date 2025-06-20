<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function show(string $key)
    {
        $policy = Policy::where('key', $key)->firstOrFail();
        return view('pages.policy_show', compact('policy'));
    }

    public function update(Request $request, string $key)
    {
        $data = $request->validate([
            'content' => 'required',
        ]);

        Policy::updateOrCreate(
            ['key' => $key],
            ['title' => ucwords(str_replace('-', ' ', $key)), 'content' => $data['content']]
        );

        return redirect()->route('dashboard')->with('status', 'Policy updated');
    }
}
