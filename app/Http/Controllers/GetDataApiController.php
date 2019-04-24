<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Message\Response;
use App\Affirmation;
use App\Category;
use Illuminate\Support\MessageBag;

class GetDataApiController extends Controller
{
    public function index()
    {
        return view('admin.api.index');
    }

    public function get(Request $request)
    {
        $customMess =[
            'apiURL.required' => 'An API URL is required'
        ];

        $request->validate([
            'apiURL' => ['required'],
        ], $customMess);

        $client = new Client();
        $data = $client->request('GET', $request->apiURL);
        $response = json_decode( $data->getBody() );

        if( $response === null ){
            $invalidError = new MessageBag();
            $invalidError->add('invalid', 'Invalid API URL');

            return redirect(route('getApi.index'))->withErrors($invalidError);
        }

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
