<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ig;
use App\Http\Requests\StoreigRequest;
use App\Http\Requests\UpdateigRequest;
use DB;

class IgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreigRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreigRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ig  $ig
     * @return \Illuminate\Http\Response
     */
    public function show(ig $ig)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ig  $ig
     * @return \Illuminate\Http\Response
     */
    public function edit(ig $ig)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateigRequest  $request
     * @param  \App\Models\ig  $ig
     * @return \Illuminate\Http\Response
     */
    public function gUrl($t){
     

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://graph.instagram.com/refresh_access_token?grant_type=ig_refresh_token%0A&access_token='.$t,
  CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: csrftoken=9B0w0O5j825r0vQp57iBvB23tyMr4b5b; ig_did=23EA93BD-D0B3-4C7A-8AE5-90E48096FBD2; ig_nrcb=1; mid=YujYzgAEAAHi3navL_r9faq5BzvT'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
// return response()->json($response);
return json_decode($response);

    }
    public function gupdate()
    {
        $response = [];
        $item =  Ig::select( '*')->get();
       
        // $gid=$item->$item[0]->id;
        $gurl=$item[0]->url;
        $gupdated_at=$item[0]->updated_at;
        $diff = now()->diffInDays($gupdated_at);
     $r=[];
        if($diff>10){
            $r=$this->gUrl($gurl);
            $gurl=$r->access_token;
            Ig::where('id', 1)->update(['url' => $r->access_token]);
            // echo $r;
        }
        return response()->json([
            "success" => true,
            "val" => "2",
            "gurl" => $gurl
        ]);
    return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ig  $ig
     * @return \Illuminate\Http\Response
     */
    public function destroy(ig $ig)
    {
        //
    }
    
public function mailChimp(Request $request){
$curl = curl_init();

curl_setopt_array($curl, array(
  // campaign id
  CURLOPT_URL => 'https://us8.api.mailchimp.com/3.0/lists/17b99f3ab4/members/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'  {  
     "email_address": "'.$request->e.'",  
     "status": "subscribed",  
     "merge_fields": {  
     "FIRSTNAME": "",  
     "LASTNAME": ""  
      }
    }',
  CURLOPT_HTTPHEADER => array(
    // apikey
    'Authorization: Basic YW55c3RyaW5nOmFhYTg2YjMzMTY1YmIxMjFjMDA1YmI4ZDkxYjU3Y2QyLXVzOA==',
    'Content-Type: application/json',
    'Cookie: ak_bmsc=B10377A94AE0C1C61A549438F0AC1A0C~000000000000000000000000000000~YAAQR2IVAny+wseDAQAA4dX7DRHZxLfZkcqV6/q42C8dOwPDmizg1xTVtjw27qnnKE+dShofs1W6FhYZHbDeAg1Br/Vb4h4ZBN6mVX7Ib77/GaxPP+l7nFqboic+UPskT3gr4Puw1EScyRO2ILY6M00ISIljeLMaW0u+6mQ+7ZzwBU1oWXAubSWf0wBnfqRRqJFhwTNYfX9r9L9CWrBGK904oRjnVaPcKJZcBm/6nOC7tNq0Hq7yFOwLAxmyDWSIJ6l7nmSaCzYEqKCeBp8X3zY00D6Q+NAGdOKimCS4jdmjN24DlOb8NtpJAOtxfbS14jkIjLA8hrG6lHovFVG8XUb0PA2RrWBkT/hnIwKrAN0u+z/vcygeAyVW6/waSl0w3tp3Eg=='
  ),
));

$response = curl_exec($curl);

curl_close($curl);
return json_decode($response);

    }
}
