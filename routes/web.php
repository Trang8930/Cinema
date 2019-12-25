<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\HomeController;

Route::get('','HomeController@trangchu');

Route::get('phim/{idphim}','HomeController@chitietphim')->where(['idphim'=>'[0-9]+']);

Route::get('phimdangchieu','HomeController@phimdangchieu');

Route::get('phimsapchieu','HomeController@phimsapchieu');

Route::get('datve/{id}','HomeController@chitietdatve')->name('datve');

Route::get('review/{id}','HomeController@review');
Route::get('blog/{id}','HomeController@blog');
Route::get('search', 'HomeController@search')->name('search');

Route::group(['prefix' => 'admin','middleware' => 'admin'], function() {
	Route::get('/','AdminController@homeadmin');
	Route::get('qlyphim','AdminController@Qlyphim')->name('qlyphim');
	Route::get('qlytintuc','AdminController@Qlytintuc')->name('qlytintuc');
	Route::get('qlyrap','AdminController@Qlyrap')->name('qlyrap');
	Route::get('qlylichchieu','AdminController@lichchieu')->name('qlylichchieu');
	Route::get('qlyphong','AdminController@dsphong')->name('qlyphong');
	Route::get('qlyghe','AdminController@dsghe');
	Route::get('qlycombo','AdminController@dscombo')->name('qlycombo');

	Route::get('users','AdminController@dsuser')->name('qlyuser');
	Route::get('users/edit/{id}','AdminController@getEditUser');
	Route::post('users/edit/{id}','AdminController@postEditUser');
	Route::get('users/delete/{id}','AdminController@delUser');

	Route::get('qlyve','AdminController@dsve');
	Route::get('addphim','AdminController@addphim');
	Route::post('formaddphim','AdminController@addphimmoi');
	Route::get('updatephim/{id}','AdminController@editphim');
	Route::post('formeditphim/{id}','AdminController@validationphim');
	Route::get('xoaphim/{idphim}','AdminController@xoap');

	Route::get('formtintuc','AdminController@formtintuc');
	Route::post('addtintuc','AdminController@addtintuc');
	Route::get('suatintuc/{idtt}','AdminController@formsuatintuc');
	Route::post('suatintuc/{idtt}','AdminController@suatintuc');
	Route::get('xoatintuc/{idtt}','AdminController@xoatintuc');

	Route::get('addrap','AdminController@addrap');
	Route::post('addrap','AdminController@addmoirap');
	Route::get('suarap/{id}','AdminController@formsuarap');
	Route::post('suarap/{id}','AdminController@suarap');
	Route::get('xoarap/{id}','AdminController@xoarap');

	Route::get('addlichchieu','AdminController@formlich')->name('addlc');
	Route::post('addlich','AdminController@addlich');
	Route::get('sualichchieu/{idlc}','AdminController@formsualich')->name('formsualich');
	Route::post('sualich','AdminController@sualich');
	Route::get('xoalich/{id}','AdminController@xoalichchieu');

	Route::get('addphong','AdminController@formphong');
	Route::post('addphong','AdminController@addphong');
	Route::get('suaphong/{id}','AdminController@formsuaphong');
	Route::post('suaphong/{id}','AdminController@suaphong');
	Route::get('xoaphong/{id}','AdminController@xoaphong');

	Route::get('addcombo','AdminController@formcombo');
	Route::post('addcombo','AdminController@addcombo');
	Route::get('xoacombo/{id}','AdminController@xoacombo');
	Route::get('suacombo/{id}','AdminController@formsuacombo');
	Route::post('suacombo/{id}','AdminController@suacombo');
	Route::get('lien-he', 'AdminController@lienHe')->name('qlylienhe');
});
Route::get('ajax/ghe/{id}','AdminController@showghe');
Route::get('ajax/lichchieu/{id}','AdminController@getlich');
Route::get('ajax/phong/{id}','AdminController@getphong');
Route::get('ajax/rap/{idphim}', 'HomeController@getRapTheoPhim');
Route::get('ajax/xem-phong/{idphim}/{idrap}', 'HomeController@getPhongTheoPhimRap');
Route::get('dangnhap','HomeController@formdangnhap');
Route::post('login','Controller@dangnhap');
Route::get('dangky','Controller@getdangky');
Route::post('dangky','HomeController@postdangky');
Route::get('dangxuat','HomeController@dangxuat');
Route::get('xemlich','HomeController@lich');
// Route::resource('ajaxdatve', 'datveajax');
Route::get('/ajaxdatve','HomeController@datve');
Route::post('cmt/{id}','HomeController@postcmt')->middleware('auth');

Route::group(['prefix' => 'user','middleware' => 'auth'], function() {
	Route::get('/','UserController@index');
});

Route::post('search', 'HomeController@search');

Route::get('lienket', function() {
   // $lk=App\ve::where('id_lichchieu',1)->get();

   // foreach ($lk as $l) {
   // 	echo $l->ghe->id;
   // }
   $lich=App\ve::find(1)->lichchieu->phim;
   return $lich;
});
Route::get('themghe', 'HomeController@themghe');
Route::get('tin-tuc', 'HomeController@getTintuc')->name('tinTuc');
Route::get('mua-ve', 'HomeController@muaVe')->name('muave');
Route::get('lien-he', 'HomeController@lienHe')->name('lienhe');
Route::post('lien-he', 'HomeController@postLienHe')->name('postLienHe');
