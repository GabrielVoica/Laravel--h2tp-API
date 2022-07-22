<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Block;
use Illuminate\Support\Facades\Auth;

class CheckUserIsNotBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        //TODO Finish middleware system
        $block = Block::where('user_id','=',Auth::user()->id)->where('room_id','=',$request->route('id'))->first();

        if(isset($block)){
            return response()->json([
                'status' => 0,
                'msg' => 'User is banned in this room',
                'data' => [
                    'reason' => $block->reason,
                    'date' => $block->created_at
                ]
            ],400);
        }


        return $next($request);
    }
}
