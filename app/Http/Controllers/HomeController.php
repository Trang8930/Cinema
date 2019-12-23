<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\slide;
use App\phim;
use App\User;
use App\lichchieu;
use App\combo;
use App\datve;
use App\cmtphim;
use App\ghe;
use App\datghe;
use App\ve;
use App\phong;
use App\rap;
use App\datcombo;
use App\lienhe;
use App\tintuc;
use Illuminate\Support\collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function trangchu()
    {
        $slide = slide::limit(3)->get();
        $phimdc = phim::where('trangthai', '1')->orderBy('id','desc')->limit(4)->get();
        $phimsc = phim::where('trangthai', '0')->orderBy('id','desc')->limit(4)->get();
        $review = tintuc::where('theloai', 1)->orderBy('id', 'desc')->limit(4)->get();
        $blog = tintuc::where('theloai', 0)->orderBy('id', 'desc')->limit(4)->get();
        return view('trangchu', compact('slide', 'phimdc', 'phimsc', 'review', 'blog'));
    }
    public function chitietphim($idphim)
    {
        $title = phim::select('tenphim')->where('id', $idphim)->get();
        foreach ($title as $td) {
            $tieude = $td->tenphim;
        }
        $phim = phim::where('id', $idphim)->get();
        $phimlq = phim::where('trangthai', '1')
            ->inRandomOrder()->limit(3)->get();

        $cmtphim = cmtphim::where('id_phim', $idphim)->get();

        $lich = lichchieu::where('id_phim', $idphim)->groupby('id_rap')->distinct()->get();

        for ($i = 0; $i < count($lich); $i++) {
            $n = lichchieu::where([['id_phim', $idphim], ['id_rap', $lich[$i]->id_rap]])->groupby('ngay')->distinct()->get();
            for ($k = 0; $k < count($n); $k++) {
                $p = lichchieu::where([['id_phim', $idphim], ['id_rap', $lich[$i]->id_rap], ['ngay', $n[$k]->ngay]])->groupby('id_phong')->distinct()->get();
                for ($j = 0; $j < count($p); $j++) {
                    $t = lichchieu::where([['id_phim', $idphim], ['id_rap', $lich[$i]->id_rap], ['ngay', $n[$k]->ngay], ['id_phong', $p[$j]->id_phong]])->get();
                    $p[$j]['time'] = $t;
                }
                $n[$k]['id_phong'] = $p;
            }

            $lich[$i]['ngay'] = $n;
        }
        // dd($lich);

        return view('phim', compact('tieude', 'phim', 'phimlq', 'lich', 'cmtphim'));
    }

    public function chitietdatve($id)
    {
        $lichchieu = lichchieu::where('id', $id)->first();
        $cb = combo::all();
        $idp = $lichchieu->id_phong;
        $ghe = ghe::where('id_phong', $idp)->groupby('row')->distinct()->get();
        //dd($cot);
        //dd($ghe);
        for ($i = 0; $i < count($ghe); $i++) {
            $g = ghe::where([['id_phong', $lichchieu->id_phong], ['row', $ghe[$i]->row]])->get();

            $ghe[$i]['number'] = $g;
        }
        //dd($ghe);

        $ve = ve::where('id_lichchieu', $id)->get();
        return view('datve', compact('lichchieu', 'cb', 'ghe', 've'));
    }

    public function review($id)
    {
        $review = tintuc::where([['id', $id], ['theloai', 1]])->get();
        return view('Review', compact('review'));
    }

    public function blog($id)
    {
        $blog = tintuc::where([['id', $id], ['theloai', 0]])->get();
        return view('blog', compact('blog'));
    }

    public function phimdangchieu()
    {
        $phimdc = phim::where('trangthai', '1')->orderBy('id', 'desc')->get();
        return view('phimdangchieu', compact('phimdc'));
    }
    public function phimsapchieu()
    {
        $phimsc = phim::where('trangthai', '0')->orderBy('id', 'desc')->get();
        return view('phimsapchieu', compact('phimsc'));
    }
    public function formdangnhap()
    {
        return view('.login.dangnhap');
    }


    public function getdangky()
    {
        return view('.login.dangky');
    }
    public function postdangky(Request $request)
    {
        $this->validate($request, [
            'pass' => 'required|min:3',
            'repass' => 'required|min:3|same:pass'
        ], [
            'repass.same' => 'Bạn chưa nhập lại mật khẩu'
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->pass);
        $user->level = 0;
        $result = $user->save();
        if($result) {
            return redirect('/');
        }else {
            return view('/dangky');
        }
        
    }
    public function dangxuat()
    {
        Auth::logout();
        return redirect('/');
    }


    public function datve(Request $req)
    {
        $ghe = $req->allseat;
        for ($i = 0; $i < count($ghe); $i++) {
            $ve = new ve;
            $ve->id_lichchieu = $req->idlich;
            $ve->id_ghe = $ghe[$i];
            $ve->id_user = $req->iduser;
            $ve->save();
        }
        $combo = $req->allcombo;
        if ($combo) {
            for ($i = 0; $i < count($combo); $i++) {
                $cb = new datcombo;
                $cb->id_lichchieu = $req->idlich;
                $cb->id_user = $req->iduser;
                $cb->id_combo = $combo[$i]['idcb'];
                $cb->soluong = $combo[$i]['slcb'];
                $cb->save();
            }
        }
        return response()->json(true, 200);
    }
    public function postcmt(Request $request, $id)
    {
        $cmt = new cmtphim;
        $cmt->id_phim = $id;
        $cmt->id_user = Auth::user()->id;
        $cmt->noidung = $request->noidungcmt;
        $cmt->save();

        return redirect()->back();
    }

    // search phim
    public function search(Request $request)
    {
        //dd($request);
        $result = phim::where('trangthai', '1')
            ->where('tenphim', 'LIKE', "%{$request->search}%")
            ->orWhere('dienvien', 'LIKE', "%{$request->search}%")
            ->get();
        return view('search', compact('result'));
    }

    public function getTintuc()
    {
        $tintuc = tintuc::select()->where('theloai', 0)->orderBy('id', 'desc')->paginate(5);
        $phimdc = phim::where('trangthai', '1')->orderBy('id', 'desc')->limit(3)->get();
        return view('tintuc', compact('tintuc', 'phimdc'));
    }

    public function lienHe() {
        $phimdc = phim::where('trangthai', '1')->orderBy('id', 'desc')->limit(3)->get();
        return view('lienhe', compact('phimdc'));
    }

    public function postLienHe(Request $request) {
        $validator = Validator::make($request->all(), [
            'ho_ten' => 'required',
            'email' => 'required|email',
            'sdt' => 'required',
            'noi_dung' => 'required',
        ]);
        if($validator->fails()) {
            return redirect()->route('lienhe')->withErrors($validator);
        } else{
            //dd($request->all());
            $lh = new lienhe();
            $lh->ho_ten = $request->ho_ten;
            $lh->email = $request->email;
            $lh->sdt = $request->sdt;
            $lh->noi_dung = $request->noi_dung;
            $lh->save();
            return redirect()->route('lienhe')->with('msg', 'Cảm ơn bạn đã để lại phản hồi');
        }
    }
    public function muaVe()
    {
        $phimdc = phim::select('id', 'tenphim', 'tentienganh', 'image')->where('trangthai', '1')->get();
        //dd($phimdc);
        return view('muaVe', compact('phimdc'));
    }

    public function getRapTheoPhim($idPhim)
    {
        $dsrap = DB::table('lichchieu as l')
            ->select('l.id_rap', 'tenrap')
            ->join('rap as r', 'l.id_rap', '=', 'r.id')
            ->where('l.id_phim', $idPhim)
            ->groupBy('l.id_rap')
            ->get();
        //dd($dsrap);
        echo "<li style='display: none;' idphim='$idPhim' id='idPhim'>&nbsp;</li>";
        foreach ($dsrap as $rap) {
            echo "<li class='item-rap' idrap='$rap->id_rap'>";
            echo $rap->tenrap;
            echo "</li>";
        }
    }

    public function getPhongTheoPhimRap($idPhim, $idRap)
    {
        $dsNgay = lichchieu::select('ngay')
            ->where('id_phim', $idPhim)
            ->where('id_rap', $idRap)
            ->orderBy('ngay', 'asc')
            ->groupBy('ngay')
            ->get();
        foreach ($dsNgay as $ngay) {
            echo "<li class='item-ngay'>" . "<p>".date('d-m-Y', strtotime($ngay->ngay))."</p>";
            $dsPhongTheoNgay = DB::table('lichchieu as l')
                ->select('l.id_phong', 'tenphong')
                ->join('phong as p', 'l.id_phong', '=', 'p.id')
                ->where('l.id_phim', $idPhim)
                ->where('l.id_rap', $idRap)
                ->where('ngay', $ngay->ngay)
                ->groupBy('id_phong')
                ->get();
            foreach ($dsPhongTheoNgay as $phong) {
                echo "<div><p class='ten-phong'>" . $phong->tenphong . "</p></div>";
                $dsGioTheoPhong = lichchieu::select('id', 'time')
                    ->where('id_phim', $idPhim)
                    ->where('id_rap', $idRap)
                    ->where('id_phong', $phong->id_phong)
                    ->where('ngay', $ngay->ngay)
                    ->orderBy('time', 'asc')
                    ->get();
                foreach ($dsGioTheoPhong as $gio) {
                    echo "<a href='/datve/$gio->id' class='gio'>" . date('G:i',strtotime($gio->time)). "</a>";
                }
            }
            echo "</li>";
        }
    }
}
