<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\phim;
use App\tintuc;
use App\rap;
use App\lichchieu;
use App\phong;
use App\ghe;
use App\combo;
use App\User;
use App\ve;
use App\datcombo;
use App\cmtphim;
use App\cmttintuc;
use App\row;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
	public function homeadmin()
	{
		$phimdc=phim::where('trangthai','1')->count();
		$phimsc=phim::where('trangthai','0')->count();
		$tintuc=tintuc::count();
		$thanhvien=user::count();
		$veban = DB::table('phim as p')
				->select('p.id as id_phim', 'tenphim', DB::raw('count(v.id_ghe) as sl'))
				->leftJoin('lichchieu as l', 'p.id', '=', 'l.id_phim')
				->leftJoin('ve as v', 'l.id', '=', 'v.id_lichchieu')
				->groupBy('p.id')
				->orderBy('id_phim', 'asc')
				->paginate(10);
		//dd($veban);
		return view('.admin.homeadmin',compact('phimdc','phimsc','tintuc','thanhvien', 'veban'));
	}
	public function Qlyphim()
	{
		$phim=phim::orderby('id','desc')->paginate(10);
		return view('.admin.qlyphim',compact('phim'));
	}
	public function Qlytintuc()
	{
		$tintuc=tintuc::paginate(10);
		return view('.admin.qlytintuc',compact('tintuc'));
	}
	public function Qlyrap()
	{
		$rap=rap::paginate(10);
		return view('.admin.qlyrap',compact('rap'));
	}
	public function lichchieu()
	{
		//$lich=lichchieu::paginate(10);
		//dd($lich);
		$lich = DB::table('lichchieu as l')->select('l.id', 'tenphim', 'tenrap', 'tenphong', 'ngay', 'time')
					->join('rap as r', 'l.id_rap', '=', 'r.id')
					->join('phong as p', 'l.id_phong', '=', 'p.id')
					->join('phim as ph', 'l.id_phim', '=', 'ph.id')
					->paginate(10);
				
		$phim=phim::where('trangthai',2)->get();
		return view('.admin.qlylichchieu',compact('lich','phim'));
	}
	public function dsphong()
	{	
		$phong=phong::paginate(5);
		return view('.admin.qlyphong',compact('phong'));
	}
	public function dsghe()
	{	$ghe=ghe::paginate(10);
		$phong=phong::all();
		return view('.admin.qlyghe',compact('ghe','phong'));
	}
	public function dscombo()
	{	
		$combo=combo::all();
		return view('.admin.qlycombo',compact('combo'));
	}

	public function dsuser()
	{	
		$user=User::paginate(10);
		return view('.admin.users.index',compact('user'));
	}

	public function getEditUser($id)
	{	
		$user = User::find($id);
		return view('admin.users.edit',compact('user'));
	}

	public function postEditUser(Request $request, $id)
	{	
		$user = User::find($id);
		$user->name = $request->name;
		$user->level = $request->level;
		$user->save();
		return redirect('/admin/users')->with('message', 'Success!');
	}

	public function delUser(Request $request, $id)
	{	
		$user = User::find($id);
		$ve = ve::where('id_user', $id)->delete();
		$cmtphim = cmtphim::where('id_user', $id)->delete();
		$cmttintuc = cmttintuc::where('id_user', $id)->delete();
		$user->delete();
		return redirect('/admin/users')->with('message', 'Success!');
	}

	public function dsve()
	{
		$ve=ve::paginate(10);
		return view('.admin.qlyve',compact('ve'));
	}

	public function addphim()
	{
		return view('.admin.phim.addphim');
	}
	public function addphimmoi(Request $request)
	{
		$phim = new phim;
		$phim->tenphim=$request->tenphim;
		$phim->tentienganh=$request->tenta;
		//$phim->image=$request->anhphim;
		if ($request->hasFile('anhphim')) {
			$image = $request->file('anhphim');
			$name = time().'.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/anhda4/phim');
			$image->move($destinationPath, $name);
			$phim->image=$name;
		}
		$phim->nsx=$request->nhasx;
		$phim->theloai=$request->theloai;
		$phim->quocgia=$request->quocgia;
		$phim->daodien=$request->daodien;
		$phim->dienvien=$request->dienvien;
		$phim->thoiluong=$request->thoiluong;
		$phim->ngaykhoichieu=$request->nkc;
		$phim->trangthai=$request->radio;
		$phim->trailer=$request->trailer;
		$phim->noidung=$request->nd;
		$phim->giave=$request->giave;
		$phim->save();
		return redirect('admin/qlyphim');

	}
	public function editphim($id)
	{
		$phim=phim::where('id',$id)->get();
		return view('.admin.phim.update',compact('phim'));
	}
	public function validationphim(Request $request,$id)
	{
		$phim=phim::find($id);
		$phim->tenphim=$request->tenphim;
		$phim->tentienganh=$request->tenta;
		if ($request->hasFile('anhphim')) {
			$image = $request->file('anhphim');
			$name = time().'.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/anhda4/phim');
			$image->move($destinationPath, $name);
			$phim->image=$name;
		}
		$phim->nsx=$request->nhasx;
		$phim->theloai=$request->theloai;
		$phim->quocgia=$request->quocgia;
		$phim->daodien=$request->daodien;
		$phim->dienvien=$request->dienvien;
		$phim->thoiluong=$request->thoiluong;
		$phim->ngaykhoichieu=$request->nkc;
		$phim->trangthai=$request->radio;
		$phim->trailer=$request->trailer;
		$phim->noidung=$request->nd;
		$phim->giave=$request->giave;
		$phim->save();
		return redirect()->route('qlyphim');
	}
	public function xoap($idphim)
	{
		phim::where('id',$idphim)->delete();
		return redirect('admin/qlyphim');
	}
	public function formtintuc()
	{
		return view('.admin.tintuc.addtintuc');
	}
	public function addtintuc(Request $request)
	{
		$tintuc=new tintuc;
		$tintuc->tieude=$request->tentintuc;
		if ($request->hasFile('anhtintuc')) {
			$image = $request->file('anhtintuc');
			$name = time().'.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/anhda4/tintuc');
			$image->move($destinationPath, $name);
			$tintuc->image=$name;
		}
		$tintuc->noidung=$request->ndtintuc;
		$tintuc->theloai=$request->radio;
		$tintuc->save();

		return redirect('admin/qlytintuc');
	}
	public function xoatintuc($idtt)
	{
		tintuc::where('id',$idtt)->delete();
		return redirect('admin/qlytintuc');
	}
	public function addrap()
	{
		return view('.admin.rap.addrap');
	}
	public function addmoirap(Request $request)
	{
		$rap= new rap;
		$rap->tenrap=$request->tenrap;
		$rap->thongtin=$request->ndrap;
		$rap->save();

		return redirect('admin/qlyrap');
	}
	public function xoarap($id)
	{
		rap::where('id',$id)->delete();
		return redirect('admin/qlyrap');
	}

	public function formlich()
	{
		$phim=phim::where('trangthai','1')->get();
		$rap=rap::all();
		return view('.admin.lichchieu.addlichchieu',compact('phim','rap'));
	}
	public function addlich(Request $request)
	{
		$lich= new lichchieu;
		$lich->id_phim=$request->phim;
		$lich->id_rap=$request->rap;
		$lich->id_phong=$request->phong;
		$lich->ngay=$request->ngay;
		$lich->time=$request->time;
		$lich->save();

		$ghe=ghe::select('id')->where('id_phong',$request->phong)->get();
		for ($i=0; $i < count($ghe) ; $i++) { 
			$ve= new ve;
			$ve->id_lichchieu=$lich->id;
			$ve->id_ghe=$ghe[$i]->id;
			$ve->id_user=null;
			$ve->save();
		}
		return redirect('admin/qlylichchieu');
	}

	public function formsualich($idlc)
	{
		$chitietlich = DB::table('lichchieu as l')
						->select('l.id', 'tenphim', 'tenrap', 'tenphong','ngay', 'time', 'l.id_rap', 'l.id_phong')
						->join('phim as p','l.id_phim', '=', 'p.id')
						->join('rap as r', 'l.id_rap', '=', 'r.id')
						->join('phong as ph', 'l.id_phong', '=', 'ph.id')
						->where('l.id', $idlc)
						->first();
		$id_rap = $chitietlich->id_rap;
		$ds_phong = phong::where('id_rap', $id_rap)->get();
		//dd($ds_phong);
						//dd($chitietlich);
		return view('.admin.lichchieu.editlichchieu',compact('chitietlich','ds_phong'));
	}

	public function sualich(Request $request)
	{
		$arr_c = [
			'id' => $request->id,
		];
		$arr_v = [
			'id_phong' => $request->phong,
			'ngay' => $request->ngay,
			'time' => $request->time
		];
		$result = lichchieu::where($arr_c)->update($arr_v);
		if($result) {
			return redirect()->route('qlylichchieu');
		} else {
			return redirect()->route('formsualich', $request->id);
		}
		//dd($arr);
	}
	public function xoalichchieu($id)
	{
		lichchieu::where('id',$id)->delete();
		return redirect('admin/qlylichchieu');
	}

	public function xoacombo($id)
	{
		combo::where('id',$id)->delete();
		return redirect('admin/qlycombo');
	}

	public function formphong()
	{
		$rap = rap::all();
		$rows = row::all();
		return view('.admin.phong.addphong', compact('rap', 'rows'));
	}
	public function addphong(Request $request)
	{
		$phong = new phong;
		$phong->tenphong=$request->tenphong;
		$phong->id_rap=$request->rap_id;
		$phong->save();
		$id_phong = $phong->id;
		$hang = $request->hang;
		$cot = $request->cot;
		// them ghe
		
		$arr = array();
		for($i = 1; $i<= $hang; $i++ ) {
			for($j = 1; $j <= $cot; $j++) {
				$arr[] = array(
					'id_phong'=> $id_phong,
					'row'=> row::find($i)->name,
					'number' => $j
				);
			}
		}
		ghe::insert($arr);
		return redirect('admin/qlyphong');
	}
	public function xoaphong($id)
	{
		phong::where('id',$id)->delete();
		return redirect('admin/qlyphong');
	}
	public function formcombo()
	{
		return view('.admin.combo.addcombo');
	}
	public function addcombo(Request $request)
	{
		$cb= new combo;
		$cb->tencombo=$request->tencb;
		$cb->chitiet=$request->chitietcb;
		$cb->gia=$request->giacb;
		$cb->save();
		return redirect('admin/qlycombo');
	}
	public function getphong($id)
	{
		$phong=phong::where('id_rap',$id)->get();
		foreach ($phong as $p) {
			echo "<option value='".$p->id."'>".$p->tenphong."</option>";
		}
	}
	public function getlich($id)
	{
		$lc=lichchieu::where('id_phim',$id)->get();
		foreach ($lc as $l) {
			echo "<tr>
			<td>".$l->id."</td>
			<td>".$l->phim->tenphim."</td>
			<td>".$l->rap->tenrap."</td>
			<td>".date('d-m-Y',strtotime($l->ngay))."</td>
			<td>".date('H:i',strtotime($l->time))."</td>
			<td><a href='admin/sualichchieu/".$l->id."'><button style='background-color: #ffffff00;border: none' title=\"Sửa\"><i class=\"fas fa-edit text-success\"></i></button></a><br>
			<form action='admin/xoalich/".$l->id."' method=\"get\" onsubmit=\"return confirm('Chắc chắn không ^_^')\">
			". csrf_field()."
			<button type=\"submit\" style=\"background-color: #ffffff00;border: none\" title=\"Xóa\"><i class=\"fas fa-trash-alt text-danger\"></i></button>
			</form></td>
			</tr>";
		}
	}
	public function showghe02($id)
	{
		$ghe=ghe::where('id_phong',$id)->groupby('row')->distinct()->get();
		for($i=0;$i<count($ghe);$i++){
			$g=ghe::where([['id_phong',1],['row',$ghe[$i]->row]])->get();

			$ghe[$i]['number']=$g;
		}
		foreach ($ghe as $g) {
			echo "<div class='seatBooking'>
			<div class='seatRow'>
			<div class='seatRowName'>
			".$g->row."
			</div>";
			foreach ($g['number'] as $n){
			echo "<div id='".$n->id."' class='seatNumber' value='".$n->row."".$n->number."'>".$n->number."</div>";
			}
			"</div></div>";
		}
	}
	public function showghe($id) {
		$rows = ghe::where('id_phong',$id)->distinct('row')->count('row');
		$cols = ghe::where('id_phong',$id)->distinct('number')->count('number');
		for($i = 1; $i <= $rows; $i++) {
			echo "<span class='seat-row'>".row::where('id', $i)->first()->name."</span>";
			for($j=1; $j <= $cols; $j++) {
				echo "<span class='seat-number'>";
				echo $j;
				echo "</span>";
			}
			echo '<br/>';
		}
	}

	public function formsuacombo($id)
	{
		$combo=combo::find($id);
		return view('admin.combo.editcombo', compact('combo'));
	}

	public function suacombo(Request $request, $id)
	{
		$combo = combo::find($id);
		$combo->tencombo=$request->tencb;
		$combo->chitiet=$request->chitietcb;
		$combo->gia=$request->giacb;
		$combo->save();
		return redirect('admin/qlycombo');
	}

	public function formsuarap($id)
	{
		$rap=rap::find($id);
		return view('admin.rap.editrap', compact('rap'));
	}

	public function suarap(Request $request, $id)
	{
		$rap = rap::find($id);
		$rap->tenrap=$request->tenrap;
		$rap->thongtin=$request->ndrap;
		$rap->save();
		return redirect('admin/qlyrap');
	}

	public function formsuaphong($id)
	{
		$rap = rap::all();
		$phong = phong::find($id);
		return view('.admin.phong.editphong', compact('rap', 'phong'));
	}
	public function suaphong(Request $request, $id)
	{
		$phong = phong::find($id);
		$phong->tenphong=$request->tenphong;
		$phong->id_rap=$request->rap_id;
		$phong->save();
		return redirect('admin/qlyphong');
	}

	public function formsuatintuc($id)
	{
		$tintuc= tintuc::find($id);
		return view('.admin.tintuc.edittintuc', compact('tintuc'));
	}
	public function suatintuc(Request $request, $id)
	{
		$tintuc = tintuc::find($id);
		$tintuc->tieude=$request->tentintuc;
		
		if ($request->hasFile('anhtintuc')) {
			$image = $request->file('anhtintuc');
			$name = time().'.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/anhda4/tintuc');
			$image->move($destinationPath, $name);
			$tintuc->image=$name;
		}
		$tintuc->noidung=$request->ndtintuc;
		$tintuc->theloai=$request->radio;
		$tintuc->save();

		return redirect('admin/qlytintuc');
	}

	
}
