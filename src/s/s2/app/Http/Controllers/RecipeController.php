<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Recipe;
use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;
use App\Http\Resources\RecipeResource;
use Illuminate\Support\Facades\Validator;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $init=$request->id;
        // $last=$request->id+4;
        if($request->direction==2){
            $recipes = RecipeResource::collection(Recipe::where('id', '<', $request->id-$request->counter)->limit($request->counter)->orderBy('id', 'DESC')->get());
        }else{
            $recipes = RecipeResource::collection(Recipe::where('id', '>', $request->id)->limit($request->counter)->get());
        }
              //
            //   $recipes = RecipeResource::collection(Recipe::all());
            //   $recipes = RecipeResource::collection(Recipe::limit(3)->get());
            //   $recipes = RecipeResource::collection(Recipe::where('id', '>', 1)->limit(4)->orderBy('id', 'ASC')->get());
             
            //   $recipes = RecipeResource::collection(Recipe::where('id', '>', $init)->where('id', '<', $last)->get());
        //    $query=Recipe::where('id', '>','3')->toSql();
        
              $count = Recipe::get()->count();
              return response()->json([
              "success" => true,
              "message" => "Recipe List",
              "val" => "2",
              "data" => $recipes,
              "count" => $count,
            //   "query" => $query
              ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRecipeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRecipeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRecipeRequest  $request
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRecipeRequest $request, Recipe $recipe)
    {
        //
    }
    public function searchRecipe(Request $request) {
        $s=$request->s;
        $recipes = [];
        $recipes = Recipe::where('name','LIKE',"%{$s}%")
        ->orWhere('description','LIKE',"%{$s}%")
        ->select('name')
        ->distinct('name')
        ->get();
        // $recipes=RecipeResource::collection(Recipe::query()
        // ->where('name','LIKE',"%{$s}%")
        // ->orWhere('description','LIKE',"%{$s}%")
        // // ->groupBy('name')
        // ->distinct('name')
        // ->get());

        return response()->json([
            "success" => true,
            "message" => "Recipe List",
            "val" => "2",
            "data" => $recipes
            ]);
    }
    public function addRecipe(Request $request) {
        $imagesName = [];
        $response = [];

        $validator = Validator::make($request->all(),
            [
                'images' => 'required',
                'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]
        );

        if($validator->fails()) {
            return response()->json(["status" => "failed", "message" => "Validation error", "errors" => $validator->errors()]);
        }
        $item = new Recipe;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->ptime = $request->pTime;
        $item->ctime = $request->cTime;
        $item->cat = $request->mCat;
        $item->dt = $request->mDate;
        $item->servings = $request->servings;
        $item->instructions = $request->Instructions;
        $item->ingredients = $request->Ingredients;
        $item->save();
        if ($file1 = $request->file('images')) {
            foreach($file1 as $file){

            $path = $file->store('public/files/'.date("Y-m-d"));
            $name = time().rand(0,3).'.'.$file->getClientOriginalName();
  
            //store your file into directory and db
            $save = new Image();
            $save->recipe_id =  $item->id;
            $save->url= $path;
            $save->save();
            }
        
               
            return response()->json([
                "success" => true,
                "message" => "File successfully uploaded",
                "code" => 2
            ]);
   
        } else {
            $response["status"] = "failed";
            $response["message"] = "Failed! image(s) not uploaded";
        }
        return response()->json($response);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Recipe::destroy($id);
        $items = RecipeResource::collection(Recipe::all());
        return response()->json([
        "success" => true,
        "message" => "Recipe List",
        "val" => "2",
        "data" => $items
        ]);
    }
}
