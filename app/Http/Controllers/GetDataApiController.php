<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Message\Response;
use App\Affirmation;
use App\Category;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\AffirmationResource;

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

            $flag = true;    
            $category = Category::firstOrCreate([ 'category_title' => $category ]);
            $affCatArray = $affirmation->CatList()->get()->toArray();

            if( count($affCatArray) == 0 )
                $affirmation->CatList()->attach($category);
            else{
                foreach( $affCatArray as $a ){
                    if( array_search($category->category_title, $a) ){
                        $flag = false;
                        break;
                    }
                }
                if($flag)
                    $affirmation->CatList()->attach($category);
            }
        }
    }

    public function JsonFile(Request $request){
        $customMess =[
            'fileName.required' => 'A File Name is required'
        ];

        $request->validate([
            'fileName' => ['required'],
        ], $customMess);

        $dataContent = Storage::disk('local')->exists($request->fileName.'.json') ? json_decode(Storage::disk('local')->get($request->fileName.'.json')) : [];
        
        $inputData = AffirmationResource::collection(Affirmation::all());

        array_push($dataContent, $inputData);

        Storage::disk('local')->put($request->fileName.'.json', json_encode($dataContent));

        $request->session()->flash('success', 'Task was successful!');

        return back();
    }

}
