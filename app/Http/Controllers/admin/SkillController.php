<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;

class SkillController extends Controller
{
    public function index(Request $request): \Illuminate\View\View|\Illuminate\Http\JsonResponse
    {
        $query = $request->input('q');

        $skills = Skill::query()
            ->when($query, function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->orderBy('sort_order')
            ->get();

        if ($request->ajax()) {
            $html = view('backend.skill._table_rows', compact('skills'))->render();
            return response()->json([
                'html'  => $html,
                'count' => $skills->count(),
                'query' => $query,
            ]);
        }

        return view('backend.skill.index', compact('skills', 'query'));
    }

    public function create(): \Illuminate\View\View
    {
        return view('backend.skill.create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'percentage' => 'required|integer|min:0|max:100',
            'icon'       => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = $request->only(['name', 'percentage', 'icon', 'sort_order']);
        $data['is_active'] = $request->has('is_active') ? true : false;

        Skill::create($data);

        return redirect()->route('admin.skills.index')
            ->with('success', 'Skill created successfully!');
    }

    public function edit($id): \Illuminate\View\View
    {
        $skill = Skill::findOrFail($id);
        return view('backend.skill.edit', compact('skill'));
    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $skill = Skill::findOrFail($id);

        $request->validate([
            'name'       => 'required|string|max:255',
            'percentage' => 'required|integer|min:0|max:100',
            'icon'       => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = $request->only(['name', 'percentage', 'icon', 'sort_order']);
        $data['is_active'] = $request->has('is_active') ? true : false;

        $skill->update($data);

        return redirect()->route('admin.skills.index')
            ->with('success', 'Skill updated successfully!');
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();

        return redirect()->route('admin.skills.index')
            ->with('success', 'Skill deleted successfully!');
    }

    public function toggleStatus($id): \Illuminate\Http\RedirectResponse
    {
        $skill = Skill::findOrFail($id);
        $skill->update(['is_active' => !$skill->is_active]);

        return redirect()->route('admin.skills.index')
            ->with('success', 'Skill status updated!');
    }
}
