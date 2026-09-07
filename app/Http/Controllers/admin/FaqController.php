<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index(Request $request): \Illuminate\View\View|\Illuminate\Http\JsonResponse
    {
        $query = $request->input('q');

        $faqs = Faq::query()
            ->when($query, function ($q) use ($query) {
                $q->where('question', 'like', "%{$query}%")
                  ->orWhere('answer', 'like', "%{$query}%");
            })
            ->orderBy('sort_order')
            ->get();

        if ($request->ajax()) {
            $html = view('backend.faq._table_rows', compact('faqs'))->render();
            return response()->json([
                'html'  => $html,
                'count' => $faqs->count(),
                'query' => $query,
            ]);
        }

        return view('backend.faq.index', compact('faqs', 'query'));
    }

    public function create(): \Illuminate\View\View
    {
        return view('backend.faq.create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'question'   => 'required|string|max:500',
            'answer'     => 'required|string',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = $request->only(['question', 'answer', 'sort_order']);
        $data['is_active'] = $request->has('is_active') ? true : false;

        Faq::create($data);

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ created successfully!');
    }

    public function edit($id): \Illuminate\View\View
    {
        $faq = Faq::findOrFail($id);
        return view('backend.faq.edit', compact('faq'));
    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $faq = Faq::findOrFail($id);

        $request->validate([
            'question'   => 'required|string|max:500',
            'answer'     => 'required|string',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = $request->only(['question', 'answer', 'sort_order']);
        $data['is_active'] = $request->has('is_active') ? true : false;

        $faq->update($data);

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ updated successfully!');
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ deleted successfully!');
    }

    public function toggleStatus($id): \Illuminate\Http\RedirectResponse
    {
        $faq = Faq::findOrFail($id);
        $faq->update(['is_active' => !$faq->is_active]);

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ status updated!');
    }
}
