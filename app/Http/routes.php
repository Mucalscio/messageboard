<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
use App\Message;
use Illuminate\Http\Request;

Route::group(['middleware' => ['web']], function () {
    /*
	 *显示主页
	 */
	Route::get('/', function () {

	    return view('messages', [
	        'messages' => Message::orderBy('created_at', 'asc')->get()
	    ]);

	});

	/*
	 *添加留言
	 */
	Route::post('/message',function(Request $request){

		//var_dump($request);

		$validator = Validator::make($request->all(), [
	        'message' => 'required|max:255',
	    ]);

	    if ($validator->fails()) {
	        return redirect('/')
	            ->withInput()
	            ->withErrors($validator);
	    }

	    $message = new Message;
	    $message->message = $request->message;
	    $message->save();

	    return redirect('/');
	});

	/*
	 *删除留言
	 */
	Route::delete('/message/{id}',function($id){
		Message::findOrFail($id)->delete();
	    return redirect('/');
	});
});
