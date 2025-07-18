<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\Gallery;
use Illuminate\Support\Str;

class PortfolioController extends Controller
{
    public function show($id)
    {
        $portfolio = Portfolio::with('category')->findOrFail($id);

        $gallery = Gallery::where('portfolioid',$portfolio->id)->get()->all();

        return response()->json([
            'title' => $portfolio->title,
            'image' => asset($portfolio->image),
            'short_desc' => $portfolio->short_desc,
            'category' => $portfolio->category->title ?? 'Uncategorized',
            'client' => $portfolio->client ?? 'N/A',
            'start_date' => $portfolio->start_date ?? '',
            'designer' => $portfolio->designer ?? 'Unknown',
            'description' => $portfolio->description,
            'live_preview_url' => $portfolio->link ?? null,
            'gallery' => $gallery ?? []
        ]);
    }
    public function index(){
        $portfoliocategory = PortfolioCategory::where('status', 'show')->get();
        $data = compact('portfoliocategory');
        return view('admin/portfolio')->with($data);
    }    
    public function portfolio(){
        $portfolio = Portfolio::with('category')->get();
        $data = compact('portfolio');
        return view('admin/viewportfolio')->with($data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'categoryid' => 'required',
            'title' => 'required|max:255',
            'company' => 'required|max:255',
            'client' => 'required|max:255',
            'designer' => 'required|max:255',
            'start_date' => 'required|date',
            'link' => 'required|url',
            'short_desc' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'status' => 'required|in:show,hide',
        ]);
        $portfolio = new Portfolio();
        $portfolio->categoryid = $request->categoryid;
        $portfolio->title = $request->title;
        $portfolio->company = $request->company;
        $portfolio->client = $request->client;
        $portfolio->designer = $request->designer;
        $portfolio->start_date = $request->start_date;
        $portfolio->link = $request->link;
        $portfolio->short_desc = $request->short_desc;
        $portfolio->description = $request->description;
        $portfolio->status = $request->status;
        if($request->image != NULL || $request->image != 0)
        {
            $img_name2 = 'portfolio'.time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('dynamic/portfolio/'), $img_name2);
            $portfolio->image = 'dynamic/portfolio/'.$img_name2;
        }
        $portfolio->save();
        return redirect()->route('admin/addportfolio')->with('message', 'Portfolio created successfully!');
    }
    

    public function edit($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        $portfoliocategory = PortfolioCategory::where('status', 'show')->get();
        return view('admin/portfolio', compact('portfolio','portfoliocategory'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'categoryid' => 'required',
            'title' => 'required|max:255',
            'company' => 'required|max:255',
            'client' => 'required|max:255',
            'designer' => 'required|max:255',
            'start_date' => 'required|date',
            'link' => 'nullable|url',
            'short_desc' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'status' => 'required|in:show,hide',
        ]);

        $portfolio = Portfolio::findOrFail($id);
        $portfolio->categoryid = $request->categoryid;
        $portfolio->title = $request->title;
        $portfolio->company = $request->company;
        $portfolio->client = $request->client;
        $portfolio->designer = $request->designer;
        $portfolio->start_date = $request->start_date;
        $portfolio->link = $request->link;
        $portfolio->short_desc = $request->short_desc;
        $portfolio->description = $request->description;
        $portfolio->status = $request->status;
        if($request->image != NULL || $request->image != 0)
        {
            $img_name2 = 'portfolio'.time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('dynamic/portfolio/'), $img_name2);
            $portfolio->image = 'dynamic/portfolio/'.$img_name2;
        }
        $portfolio->save();
    
        return redirect()->route('admin/editportfolio',$id)->with('message', 'Portfolio updated successfully.');
    }
    

    public function viewportfoliocategory(){
        $portfoliocategory = PortfolioCategory::get()->all();
        $data = compact('portfoliocategory');
        return view('admin/viewportfoliocategory')->with($data);
    }
    public function insertportfoliocategory(Request $request){

        $validated = $request->validate([
            'title' => 'required',
            'status' => 'required|in:show,hide'
        ]);

        $PortfolioCategory = new PortfolioCategory();
        $PortfolioCategory->title = $request->title;
        $PortfolioCategory->slug = Str::slug($request->title);
        $PortfolioCategory->status = $request->status;

        $PortfolioCategory->save();

        return redirect()->back()->with('message', 'Portfolio Category Inserted Successfully!');
    }
    public function editportfoliocategory($id)
    {
        $category = PortfolioCategory::findOrFail($id);
        $portfoliocategory = PortfolioCategory::get()->all();
        return view('admin/viewportfoliocategory', compact('category','portfoliocategory'));
    }
    public function updateportfoliocategory(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'status' => 'required|in:show,hide',
        ]);

        $PortfolioCategory = PortfolioCategory::findOrFail($id);
        $PortfolioCategory->title = $request->title;
        $PortfolioCategory->slug = Str::slug($request->title);
        $PortfolioCategory->status = $request->status;

        $PortfolioCategory->save();

        return redirect()->route('admin/viewportfoliocategory')->with('message', 'Portfolio Category updated successfully!');
    }
    public function gallery($id)
    {
        $rowId = $id;
        $gallery = Gallery::where('portfolioid', $id)->with('portfolio')->get();
        return view('admin/portfoliogallery', compact('gallery','rowId'));
    }
    public function insertportfoliogallery($id, Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif'
        ]);

        $gallery = new Gallery;
        $gallery->portfolioid = $id;
        if($request->image != NULL || $request->image != 0)
        {
            $img_name2 = 'portfolio'.time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('dynamic/gallery/'), $img_name2);
            $gallery->image = 'dynamic/gallery/'.$img_name2;
        }
        $gallery->save();
    
        return redirect()->back()->with('message', 'Gallery Created successfully');
    }
    public function deleteGallery($id)
    {
        $gallery = Gallery::findOrFail($id);
        $imagePath = public_path($gallery->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $gallery->delete();                        
        return redirect()->back()->with('error', 'Gallery deleted successfully');
    }


}
