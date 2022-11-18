<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\blog;
use App\Http\Requests\StoreblogRequest;
use App\Http\Requests\UpdateblogRequest;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $blogs = Blog::all();
        $blogs = Blog::select( 'id','cover','header','created_at')->get();
            //   $count = Recipe::get()->count();
              return response()->json([
              "success" => true,
              "message" => "Blog List",
              "val" => "2",
              "data" => $blogs,
            //   "count" => $count,
            //   "query" => $query
              ]);
    }
    public function desc(Request $request)
    {
            // $blogs = Blog::all();
            $dec = DB::table('blogs')
            ->where('id', '=', $request->id)
            ->select( 'id','blog')
            ->get();
            //   $count = Recipe::get()->count();
              return response()->json([
              "success" => true,
              "message" => "Recipe List",
              "val" => "2",
              "data" => $desc,
            //   "count" => $count,
            //   "query" => $query
              ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $response = [];
        $item = new Blog;
        $item->blog = $request->blog;
        $item->header = $request->header;
        if ($file1 = $request->file('images')) {
            foreach($file1 as $file){

            $path = $file->store('public/files/'.date("Y-m-d"));
            $name = time().rand(0,3).'.'.$file->getClientOriginalName();
            $item->cover= $path;
            // $save->save();
            }
            // return response()->json([
            //     "success" => true,
            //     "message" => "Filez successfully uploaded",
            //     "code" => 2
            // ]);
   
        }
        $item->save();

        return response()->json([
            "success" => true,
            "message" => "Data successfully uploaded",
            "code" => 2
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreblogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreblogRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateblogRequest  $request
     * @param  \App\Models\blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateblogRequest $request, blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BLog::destroy($id);
        $items = Blog::all();
        return response()->json([
        "success" => true,
        "message" => "Blogs List",
        "val" => "2",
        "data" => $items
        ]);
    }
}
