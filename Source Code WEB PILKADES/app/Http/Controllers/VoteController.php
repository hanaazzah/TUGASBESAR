<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kades;
use App\Pemilih;
use Illuminate\Support\Facades\Session;
use App\Vote;
use App\VoteCount;
use App\LoginVote;

class VoteController extends Controller
{
    protected $kades;
    protected $pemilih;
    protected $voteCount;

    public function __construct()
    {
        $this->kades = new Kades;
        $this->pemilih = new Pemilih;
        $this->vote = new Vote;
        $this->voteCount = new VoteCount;
    }

    public function index()
    {
        $clientIP = env('CLIENT_IP');
        $checkLogin = LoginVote::where('ip', $clientIP)->get();
        if ($checkLogin->count() > 0) {
            $id = LoginVote::where('ip', $clientIP)->first()->login_id;
            $nik = $this->pemilih->where('id', $id)->first();
            if ($nik != null) {
                if ($checkLogin->count() > 0) {
                    return redirect('/vote_now')->with(['success' => 'Data Ditemukan', 'nik' => $nik->nik]);
                }
            } else {
                LoginVote::where('ip', $clientIP)->delete();
            }
        }
        return view('welcome');
    }

    public function enroll(Request $request)
    {
        $id = $request->get('id');
        $pemilih = $this->pemilih->where('id', $id)->get();
        if ($pemilih->count() > 0) {
            $this->pemilih->where('id', $id)->update([
                "status_finger" => "yes"
            ]);
            return response()->json([
                "status" => "success",
                "message" => "Data Pemilih Berhasil diSimpan!"
            ]);
        }
        return response()->json([
            "status" => "failed",
            "message" => "Pemilih Harus Terdaftar di Website Terlebih Dahulu!"
        ]);
    }

    public function loginVote(Request $request)
    {
        $id = $request->get("id");
        $clientIP = env('CLIENT_IP');

        $checkPemilih = $this->pemilih->where('id', $id)->get();
        if ($checkPemilih->count() > 0) {
            $loginVote = LoginVote::create([
                "ip" => $clientIP,
                "login_id" => $id
            ]);
            if ($loginVote) {
                return response()->json(["message" => "Login Sukses! Silahkan untuk Memilih"]);
            } else {
                return response()->json(["message" => "Login Gagal! Anda Sudah Pernah Memilih"]);
            }
        } else {
            return response()->json(["message" => "Login Gagal! Silahkan Lakukan Pendaftaran Terlebih Dahulu"]);
        }
    }

    public function loginData()
    {
        $clientIP = env('CLIENT_IP');
        $data = loginVote::where('ip', $clientIP)->first();
        return response()->json($data);
    }

    public function findUser(Request $request)
    {
        $nik = $request->nik;
        if ($nik == '') {
            return redirect('/')->with(['warning' => 'Nik tidak boleh kosong']);
        } else {
            $user = $this->pemilih->where('nik', $nik)->get();
            if ($user->count() > 0) {
                $getUser = $this->getUser($nik);
                $checkVote = $this->checkVote($getUser->id);
                if ($checkVote->count() > 0) {
                    $alert = "Pemilih dengan Nik : " . $nik . " Pernah Memilih";
                    return redirect('/')->with(['warning' => $alert]);
                }
                return redirect('/vote_now')->with(['success' => 'Data Ditemukan', 'nik' => $nik]);
            } else {
                $alert = "Pemilih dengan Nik : " . $nik . " Tidak Ditemukan";
                return redirect('/')->with(['warning' => $alert]);
            }
        }
    }

    public function checkVote($id)
    {
        $vote = $this->vote->where('id_pemilih', $id)->get();
        return $vote;
    }

    public function voteNow()
    {
        if ($nik = Session::get('nik')) {
            $getUser = $this->getUser($nik);
            $checkVote = $this->checkVote($getUser->id);
            if ($checkVote->count() > 0) {
                LoginVote::where('login_id', $getUser->id)->delete();
                $alert = "Pemilih dengan Nik : " . $nik . " Pernah Memilih";
                return redirect('/')->with(['warning' => $alert]);
            } else {
                $kades = $this->kades->get();
                return view('vote_now', compact('kades', 'getUser'));
            }
        }
        return redirect('/');
    }

    public function select(Request $request)
    {
        $request->validate([
            "id_pemilih" => "required",
            "id_kades" => "required"
        ]);

        $this->vote->create([
            "id_pemilih" => $request->id_pemilih
        ]);
        $vote = $this->voteAction($request->id_kades);
        if ($vote) {
            LoginVote::where('login_id', $request->id_pemilih)->delete();
            return redirect('/')->with(['success' => 'Terimakasi Telah Melakukan Pemilihan Kepala Desa']);
        }
        return redirect('/')->with(['danger' => 'Terjadi Kesalahan Silahkan Coba Lagi']);
    }

    public function finish()
    {
        return view('finish');
    }

    public function voteAction($id)
    {
        $kades = $this->voteCount->where('id_kades', $id);
        if ($kades->count() == 0) {
            $sumVote = $this->updateVote($id, 1);
            return $sumVote;
        } else {
            $checkCount = $kades->first()->count;
            $resultVote = $checkCount + 1;
            $sumVote = $this->updateVote($id, $resultVote);
            return $sumVote;
        }
    }

    public function counts()
    {
        $counts = $this->voteCount->get();
        $result = [];
        if ($counts->count() > 0) {
            foreach ($counts as $key => $value) {
                $result[] = [
                    "id_kades" => $value->id_kades,
                    "count" => $value->count,
                    "persentase" => round($this->persentation($value->count))
                ];
            }
        }
        return response()->json($result);
    }

    public function persentation($count)
    {
        $countAllVoters = $this->vote->get()->count();
        $pesentation = ($count / $countAllVoters) * 100;
        return $pesentation;
    }

    public function updateVote($id, $count)
    {
        $vote = $this->voteCount->updateOrCreate(
            ["id_kades" => $id],
            ["count" => $count, "id_kades" => $id]
        );
        return $vote;
    }

    public function getUser($nik)
    {
        return $this->pemilih->where('nik', $nik)->first();
    }

    public function vote()
    {
        $kades = $this->kades->get();
        return view('vote', compact('kades'));
    }
}
