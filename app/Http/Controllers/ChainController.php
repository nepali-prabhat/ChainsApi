<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chain;
class ChainController extends Controller
{
    public function makeChain(Request $request){
        $this->validate($request,[
            "date_time"=>'required',
            "duration"=>'required'
        ]);

        $input = $request->all();
        $input['user_id'] = $request->auth;
        $input["completed"] = false;
        $chain = Chain::create($input);
        return $chain;
    }
    public function completeChain($id){

        $chain = Chain::findOrFail($id);
        $chain->completed = true;
        $chain->save();
        return $chain;
    }

    public function getUserChains($id){
        $chains = Chain::where('user_id',$id)->get();
        return $chains;
    }

    public function getCompletedChain($id){
        $chains = Chain::where(['user_id'=>$id,'completed'=>true])->get();
        return $chains;
    }

}
