<?php
// admin panel android routes
Route::get('/get/{modelName}','AndroidPanelController@get');
Route::post('/store/{modelName}','AndroidPanelController@store');
//Route::post('/delete/{modelName}','AndroidPanelController@delete');
Route::get('delete/{modelName}',function(){
    return view('delete');
});
Route::get('/delete/{modelName}',function (){
   echo $_GET['userid'];
    echo "salam";
});



?>
