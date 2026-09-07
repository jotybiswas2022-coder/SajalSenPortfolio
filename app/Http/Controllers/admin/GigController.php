<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gig;
use Illuminate\Support\Facades\Storage;

class GigController extends Controller
{
    public function index(Request $request): \Illuminate\View\View|\Illuminate\Http\JsonResponse
    {
        $query = $request->input('q');

        $gigs = Gig::query()
            ->when($query, function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%");
            })
            ->orderBy('sort_order')
            ->get();

        if ($request->ajax()) {
            $html = view('backend.gig._table_rows', compact('gigs'))->render();
            return response()->json([
                'html'  => $html,
                'count' => $gigs->count(),
                'query' => $query,
            ]);
        }

        return view('backend.gig.index', compact('gigs', 'query'));
    }

    public function create(): \Illuminate\View\View
    {
        return view('backend.gig.create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'title'             => 'required|string|max:255',
            'short_description' => 'nullable|string|max:255',
            'description'       => 'nullable|string',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'basic_name'        => 'nullable|string|max:100',
            'basic_price'       => 'required|string|max:100',
            'basic_features'    => 'nullable|string',
            'standard_name'     => 'nullable|string|max:100',
            'standard_price'    => 'required|string|max:100',
            'standard_features' => 'nullable|string',
            'premium_name'      => 'nullable|string|max:100',
            'premium_price'     => 'required|string|max:100',
            'premium_features'  => 'nullable|string',
            'sort_order'        => 'nullable|integer|min:0',
        ]);

        $data = $request->except(['_token', 'image']);
        $data['is_active'] = $request->has('is_active') ? true : false;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('gigs', 'public');
        }

        Gig::create($data);

        return redirect()->route('admin.gigs.index')
            ->with('success', 'Gig created successfully!');
    }

    public function edit($id): \Illuminate\View\View
    {
        $gig = Gig::findOrFail($id);
        return view('backend.gig.edit', compact('gig'));
    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $gig = Gig::findOrFail($id);

        $request->validate([
            'title'             => 'required|string|max:255',
            'short_description' => 'nullable|string|max:255',
            'description'       => 'nullable|string',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'basic_name'        => 'nullable|string|max:100',
            'basic_price'       => 'required|string|max:100',
            'basic_features'    => 'nullable|string',
            'standard_name'     => 'nullable|string|max:100',
            'standard_price'    => 'required|string|max:100',
            'standard_features' => 'nullable|string',
            'premium_name'      => 'nullable|string|max:100',
            'premium_price'     => 'required|string|max:100',
            'premium_features'  => 'nullable|string',
            'sort_order'        => 'nullable|integer|min:0',
        ]);

        $data = $request->except(['_token', '_method', 'image']);
        $data['is_active'] = $request->has('is_active') ? true : false;

        if ($request->hasFile('image')) {
            if ($gig->image) {
                Storage::disk('public')->delete($gig->image);
            }
            $data['image'] = $request->file('image')->store('gigs', 'public');
        }

        $gig->update($data);

        return redirect()->route('admin.gigs.index')
            ->with('success', 'Gig updated successfully!');
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $gig = Gig::findOrFail($id);
        if ($gig->image) {
            Storage::disk('public')->delete($gig->image);
        }
        $gig->delete();

        return redirect()->route('admin.gigs.index')
            ->with('success', 'Gig deleted successfully!');
    }

    public function deleteImage($id): \Illuminate\Http\RedirectResponse
    {
        $gig = Gig::findOrFail($id);
        if ($gig->image && Storage::disk('public')->exists($gig->image)) {
            Storage::disk('public')->delete($gig->image);
        }
        $gig->image = null;
        $gig->save();
        return redirect()->back()->with('success', 'Gig image deleted successfully!');
    }

    public function toggleStatus($id): \Illuminate\Http\RedirectResponse
    {
        $gig = Gig::findOrFail($id);
        $gig->update(['is_active' => !$gig->is_active]);

        return redirect()->route('admin.gigs.index')
            ->with('success', 'Gig status updated!');
    }
}
