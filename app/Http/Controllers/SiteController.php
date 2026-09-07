<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\EducationQualification;
use App\Models\Service;
use App\Models\Faq;
use App\Models\CaseStudy;
use App\Models\Gig;

class SiteController extends Controller
{
    public function index(): \Illuminate\View\View {
        $account = Account::first(); 
        $projects = Project::active()->get();
        $testimonials = Testimonial::active()->get();
        $experiences = Experience::active()->get();
        $skills = Skill::active()->get();
        $educations = EducationQualification::active()->get();
        $services = Service::active()->get();
        $faqs = Faq::active()->get();
        $caseStudies = CaseStudy::active()->get();
        $gigs = Gig::active()->get();
        return view('frontend.index', compact('account', 'projects', 'testimonials', 'experiences', 'educations', 'skills', 'services', 'faqs', 'caseStudies', 'gigs'));
    }

    public function gigDetail($id): \Illuminate\View\View {
        $gig = Gig::findOrFail($id);
        $suggestedGigs = Gig::active()->where('id', '!=', $id)->take(3)->get();
        return view('frontend.gig-detail', compact('gig', 'suggestedGigs'));
    }

    public function caseStudyDetail($id): \Illuminate\View\View {
        $caseStudy = CaseStudy::findOrFail($id);
        return view('frontend.case-study-detail', compact('caseStudy'));
    }

    public function projectDetail($id): \Illuminate\View\View {
        $project = Project::findOrFail($id);
        return view('frontend.project-detail', compact('project'));
    }
}
