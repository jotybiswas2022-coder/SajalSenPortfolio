<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the testimonials.
     */
    public function index(Request $request): \Illuminate\View\View|\Illuminate\Http\JsonResponse
    {
        $query = $request->input('q');

        $testimonials = Testimonial::query()
            ->when($query, function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('designation', 'like', "%{$query}%")
                  ->orWhere('company', 'like', "%{$query}%")
                  ->orWhere('message', 'like', "%{$query}%");
            })
            ->orderBy('sort_order')
            ->get();

        if ($request->ajax()) {
            $html = view('backend.testimonial._table_rows', compact('testimonials'))->render();
            return response()->json([
                'html'  => $html,
                'count' => $testimonials->count(),
                'query' => $query,
            ]);
        }

        return view('backend.testimonial.index', compact('testimonials', 'query'));
    }

    /**
     * Show the form for creating a new testimonial.
     */
    public function create(): \Illuminate\View\View
    {
        return view('backend.testimonial.create');
    }

    /**
     * Store a newly created testimonial in storage.
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'company'     => 'nullable|string|max:255',
            'message'     => 'required|string',
            'rating'      => 'nullable|integer|min:1|max:5',
            'avatar'      => 'nullable|image|max:2048',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        $data = $request->only([
            'name', 'designation', 'company', 'message', 'rating', 'sort_order'
        ]);

        $data['is_active'] = $request->has('is_active') ? true : false;
        $data['rating']    = $request->rating ?? 5;

        // Avatar upload
        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('testimonials', 'public');
        }

        Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial created successfully!');
    }

    /**
     * Show the form for editing the specified testimonial.
     */
    public function edit($id): \Illuminate\View\View
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('backend.testimonial.edit', compact('testimonial'));
    }

    /**
     * Update the specified testimonial in storage.
     */
    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $testimonial = Testimonial::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'company'     => 'nullable|string|max:255',
            'message'     => 'required|string',
            'rating'      => 'nullable|integer|min:1|max:5',
            'avatar'      => 'nullable|image|max:2048',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        $data = $request->only([
            'name', 'designation', 'company', 'message', 'rating', 'sort_order'
        ]);

        $data['is_active'] = $request->has('is_active') ? true : false;
        $data['rating']    = $request->rating ?? 5;

        // Avatar upload
        if ($request->hasFile('avatar')) {
            if ($testimonial->avatar && Storage::disk('public')->exists($testimonial->avatar)) {
                Storage::disk('public')->delete($testimonial->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('testimonials', 'public');
        }

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial updated successfully!');
    }

    /**
     * Remove the specified testimonial from storage.
     */
    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $testimonial = Testimonial::findOrFail($id);

        if ($testimonial->avatar && Storage::disk('public')->exists($testimonial->avatar)) {
            Storage::disk('public')->delete($testimonial->avatar);
        }

        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial deleted successfully!');
    }

    public function deleteImage($id): \Illuminate\Http\RedirectResponse
    {
        $testimonial = Testimonial::findOrFail($id);
        if ($testimonial->avatar && Storage::disk('public')->exists($testimonial->avatar)) {
            Storage::disk('public')->delete($testimonial->avatar);
        }
        $testimonial->avatar = null;
        $testimonial->save();
        return redirect()->back()->with('success', 'Client avatar deleted successfully!');
    }

    /**
     * Toggle testimonial active status.
     */
    public function toggleStatus($id): \Illuminate\Http\RedirectResponse
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update(['is_active' => !$testimonial->is_active]);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial status updated!');
    }
}
