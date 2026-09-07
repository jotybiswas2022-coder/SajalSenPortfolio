<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EducationQualification;

class EducationQualificationController extends Controller
{
    public function index(Request $request): \Illuminate\View\View|\Illuminate\Http\JsonResponse
    {
        $query = $request->input('q');

        $educations = EducationQualification::query()
            ->when($query, function ($q) use ($query) {
                $q->where('degree_name', 'like', "%{$query}%")
                  ->orWhere('institution', 'like', "%{$query}%");
            })
            ->orderBy('display_order')
            ->get();

        if ($request->ajax()) {
            $html = view('backend.education._table_rows', compact('educations'))->render();
            return response()->json([
                'html'  => $html,
                'count' => $educations->count(),
                'query' => $query,
            ]);
        }

        return view('backend.education.index', compact('educations', 'query'));
    }

    public function create(): \Illuminate\View\View
    {
        return view('backend.education.create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'degree_name'        => 'required|string|max:255',
            'institution'        => 'required|string|max:255',
            'board_or_university' => 'nullable|string|max:255',
            'duration'           => 'required|string|max:100',
            'result'             => 'nullable|string|max:255',
            'display_order'      => 'nullable|integer|min:0',
        ]);

        $data = $request->only(['degree_name', 'institution', 'board_or_university', 'duration', 'result', 'display_order']);
        $data['is_active'] = $request->has('is_active') ? true : false;

        EducationQualification::create($data);

        return redirect()->route('admin.education.index')
            ->with('success', 'Education qualification created successfully!');
    }

    public function edit($id): \Illuminate\View\View
    {
        $education = EducationQualification::findOrFail($id);
        return view('backend.education.edit', compact('education'));
    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $education = EducationQualification::findOrFail($id);

        $request->validate([
            'degree_name'        => 'required|string|max:255',
            'institution'        => 'required|string|max:255',
            'board_or_university' => 'nullable|string|max:255',
            'duration'           => 'required|string|max:100',
            'result'             => 'nullable|string|max:255',
            'display_order'      => 'nullable|integer|min:0',
        ]);

        $data = $request->only(['degree_name', 'institution', 'board_or_university', 'duration', 'result', 'display_order']);
        $data['is_active'] = $request->has('is_active') ? true : false;

        $education->update($data);

        return redirect()->route('admin.education.index')
            ->with('success', 'Education qualification updated successfully!');
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $education = EducationQualification::findOrFail($id);
        $education->delete();

        return redirect()->route('admin.education.index')
            ->with('success', 'Education qualification deleted successfully!');
    }

    public function toggleStatus($id): \Illuminate\Http\RedirectResponse
    {
        $education = EducationQualification::findOrFail($id);
        $education->update(['is_active' => !$education->is_active]);

        return redirect()->route('admin.education.index')
            ->with('success', 'Education qualification status updated!');
    }
}
