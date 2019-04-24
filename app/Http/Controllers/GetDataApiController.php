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

        //for checking invalid url
        if( $response === null ){
            $invalidError = new MessageBag();
            $invalidError->add('invalid', 'Invalid API URL');

            return redirect(route('getApi.index'))->withErrors($invalidError);
        }
        //

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

 
            // if( $affirmation->id == '1031'){
            //     var_dump( in_array( $category->category_title, $affirmation->CatList()->get()->toArray() ) );
            //     var_dump( $category->category_title );
            //     var_dump( $affirmation->CatList()->get()->toArray() );
            // }

            // if( !in_array( $category->category_title, $affirmation->CatList()->get()->toArray() ) ){

            //     $affirmation->CatList()->attach($category);

            // }    

            // var_dump($affirmation->CatList()->get())

            $categoryLocalArray = $affirmation->CatList()->get()->toArray();

            if( count($categoryLocalArray) == 0 )
                $affirmation->CatList()->attach($category);
            else{
                for ($i=0; $i < count($categoryLocalArray) ; $i++) { 

                    var_dump([ 
                        $category->category_title,  
                        $categoryLocalArray[$i]["category_title"]
                        ]);

                    if( $category->category_title != $categoryLocalArray[$i]["category_title"] )
                        $affirmation->CatList()->attach($category);

                }
            }
        }

    }

}
