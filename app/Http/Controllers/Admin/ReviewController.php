<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;

class ReviewController extends Controller
{

    private $locales;
    public function __construct()
    {
        $this->locales = Language::all();
        view()->share(['locales' => $this->locales]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd($this->locales);
        $reviews = Review::latest('id')->paginate();

        return view('admins.reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.reviews.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReviewRequest $request)
    {
        $locales = Language::active()->get()->pluck('code')->toArray();
        $review = new Review();
        foreach ($locales as  $locale) {
            $review->translateOrNew($locale)->comment = $request->get('comment_' . $locale);
        }
        $review->rate = $request->rate;
        $review->product = $request->product_id;

        $review->save();

        flash()->success('Review Created Successfully');
        return redirect()->route('admin.review.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        return view('admins.reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReviewRequest $request, Review $review)
    {
        $locales = Language::active()->get()->pluck('code')->toArray();
        foreach ($locales as  $locale) {
            $review->translateOrNew($locale)->comment = $request->get('comment_' . $locale);
        }

        $review->rate = $request->rate;
        $review->product = $request->product_id;
        $review->save();

        flash()->success('Review Updated Successfully');
        return redirect()->route('admin.review.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();
        flash()->success('Review Deleted Successfully');
        return redirect()->route('admin.review.index');
    }
}
