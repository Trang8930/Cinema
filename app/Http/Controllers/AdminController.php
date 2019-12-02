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

class AdminController extends Controller
{
	public function homeadmin()
	{
		$phimdc=phim::where('trangthai','1')->count();
		$phimsc=phim::where('trangthai','0')->count();
		$tintuc=tintuc::count();
		$thanhvien=user::where('level',0)->count();

		$lichchieu=lichchieu::groupby('id_phim')->distinct()->paginate(10);
		for ($i=0; $i < count($lichchieu) ; $i++) { 
			$ve=ve::where([['id_lichchieu',$lichchieu[$i]->id],['id_user','<>','NULL']])->count();
			$lichchieu[$i]['id_rap']=$ve;
		}
		//print($lichchieu);
		return view('.admin.homeadmin',compact('phimdc','phimsc','tintuc','thanhvien','lichchieu'));
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
		$lich=lichchieu::paginate(10);
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
	{	$user=User::paginate(10);
		return view('.admin.qlyuser',compact('user'));
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
		$phim->image=$request->anhphim;
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
		$phim=phim::where('id',$id)->update([
			'tenphim'=>$request->tenphim,
			'tentienganh'=>$request->tenta,
			'image'=>$request->anhphim,
			'nsx'=>$request->nhasx,
			'theloai'=>$request->theloai,
			'quocgia'=>$request->quocgia,
			'daodien'=>$request->daodien,
			'dienvien'=>$request->dienvien,
			'thoiluong'=>$request->thoiluong,
			'ngaykhoichieu'=>$request->nkc,
			'trangthai'=>$request->radio,
			'trailer'=>$request->trailer,
			'noidung'=>$request->nd,
			'giave'=>$request->giave
		]);
		return redirect()->back()->with('thongbao','Đã Sửa Thành Công ^_^');
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
		$phim=phim::where('trangthai','1')->get();
		$rap=rap::all();
		$lich=lichchieu::find($idlc);
		return view('.admin.lichchieu.editlichchieu',compact('lich','phim','rap'));
	}

	public function sualich()
	{
		
	}
	public function xoalichchieu($id)
	{
		lichchieu::where('id',$id)->de;
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
		return view('.admin.phong.addphong', compact('rap'));
	}
	public function addphong(Request $request)
	{
		$phong = new phong;
		$phong->tenphong=$request->tenphong;
		$phong->id_rap=$request->rap_id;
		$phong->save();
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
	public function showghe($id)
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
