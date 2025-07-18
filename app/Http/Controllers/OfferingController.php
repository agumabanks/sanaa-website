<?php

namespace App\Http\Controllers;

use App\Models\Offering;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OfferingController extends Controller
{
    public function index(string $type)
    {
        $items = Offering::where('type', $type)->get();
        $view = $type === 'service' ? 'pages.services' : 'pages.products';
        return view($view, compact('items'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'type' => 'required',
            'description' => 'nullable',
            'link' => 'nullable|url',
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('offerings', 'public');
        }

        Offering::create($data);

        return redirect()->route('dashboard.offerings')->with('status', 'Offering created');
    }

    public function update(Request $request, Offering $offering)
    {
        $data = $request->validate([
            'title' => 'required',
            'type' => 'required',
            'description' => 'nullable',
            'link' => 'nullable|url',
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            if ($offering->image) {
                Storage::disk('public')->delete($offering->image);
            }
            $data['image'] = $request->file('image')->store('offerings', 'public');
        }

        $offering->update($data);

        return redirect()->route('dashboard.offerings')->with('status', 'Offering updated');
    }

    public function destroy(Offering $offering)
    {
        if ($offering->image) {
            Storage::disk('public')->delete($offering->image);
        }
        $offering->delete();
        return redirect()->route('dashboard.offerings')->with('status', 'Offering deleted');
    }
}
