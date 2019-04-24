<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Message\Response;
use App\Affirmation;
use App\Category;

class GetDataApiController extends Controller
{
    public function index()
    {
        return view('admin.api.index');
    }

    public function get(Request $request)
    {
        $client = new Client();
        $data = $client->request('GET', $request->apiURL);
        $response = json_decode( $data->getBody() );

        foreach($response as $r){
            $this->CheckAddAff($r);
        }

        return view('admin.api.show', compact( 'response' ) );
    }

    public function CheckAddAff( $thing ){

        $affirmation = Affirmation::firstOrCreate([ 'id' => $thing->ID ]);
        $affirmation->aff_content = $thing->AFFIRMATION;
        $affirmation->save();

        foreach( $thing->CATEGORIES as $category){
            $category = Category::firstOrCreate([ 'category_title' => $category ]);
            $affirmation->CatList()->attach($category);
        }
    
    }

}
