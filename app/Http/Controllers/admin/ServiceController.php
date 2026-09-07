<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index(Request $request): \Illuminate\View\View|\Illuminate\Http\JsonResponse
    {
        $query = $request->input('q');

        $services = Service::query()
            ->when($query, function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('short_description', 'like', "%{$query}%");
            })
            ->orderBy('sort_order')
            ->get();

        if ($request->ajax()) {
            $html = view('backend.service._table_rows', compact('services'))->render();
            return response()->json([
                'html'  => $html,
                'count' => $services->count(),
                'query' => $query,
            ]);
        }

        return view('backend.service.index', compact('services', 'query'));
    }

    public function create(): \Illuminate\View\View
    {
        return view('backend.service.create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'title'             => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description'       => 'nullable|string',
            'icon'              => 'nullable|string|max:100',
            'sort_order'        => 'nullable|integer|min:0',
        ]);

        $data = $request->only(['title', 'short_description', 'description', 'icon', 'sort_order']);
        $data['is_active'] = $request->has('is_active') ? true : false;

        Service::create($data);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service created successfully!');
    }

    public function edit($id): \Illuminate\View\View
    {
        $service = Service::findOrFail($id);
        return view('backend.service.edit', compact('service'));
    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $service = Service::findOrFail($id);

        $request->validate([
            'title'             => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description'       => 'nullable|string',
            'icon'              => 'nullable|string|max:100',
            'sort_order'        => 'nullable|integer|min:0',
        ]);

        $data = $request->only(['title', 'short_description', 'description', 'icon', 'sort_order']);
        $data['is_active'] = $request->has('is_active') ? true : false;

        $service->update($data);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully!');
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service deleted successfully!');
    }

    public function toggleStatus($id): \Illuminate\Http\RedirectResponse
    {
        $service = Service::findOrFail($id);
        $service->update(['is_active' => !$service->is_active]);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service status updated!');
    }
}
