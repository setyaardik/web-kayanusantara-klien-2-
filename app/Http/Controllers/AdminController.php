<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Destinasi;
use App\Models\Faq;
use App\Models\LangkahDokumentasi;
use App\Models\LangkahGaleri;
use App\Models\LangkahPublikasi;
use App\Models\Mitra;
use App\Models\Testimoni;
use App\Models\TokoProduk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function showLogin()
    {
        if (auth()->check() && auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $login = $request->input('username');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        $user = User::where($field, $login)->first();

        if ($user && $user->role === 'admin' && Hash::check($request->input('password'), $user->password)) {
            auth()->login($user, $request->boolean('remember'));
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors(['username' => 'Username/email atau password admin salah.'])->withInput();
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        return view('admin.dashboard', [
            'counts' => [
                'faq' => Faq::count(),
                'testimoni' => Testimoni::count(),
                'mitra' => Mitra::count(),
                'berita' => Berita::count(),
                'toko' => TokoProduk::count(),
                'agenda' => Agenda::count(),
                'destinasi' => Destinasi::count(),
                'user' => User::count(),
            ],
        ]);
    }

    // --- FAQ ---
    public function faqIndex() { return view('admin.home.faq-index', ['items' => Faq::orderBy('urutan')->orderBy('id')->get()]); }
    public function faqCreate() { return view('admin.home.faq-form', ['item' => new Faq()]); }
    public function faqStore(Request $r) { Faq::create($this->faqData($r)); return redirect()->route('admin.faq.index')->with('ok', 'FAQ ditambahkan.'); }
    public function faqEdit(Faq $faq) { return view('admin.home.faq-form', ['item' => $faq]); }
    public function faqUpdate(Request $r, Faq $faq) { $faq->update($this->faqData($r)); return redirect()->route('admin.faq.index')->with('ok', 'FAQ diperbarui.'); }
    public function faqDestroy(Faq $faq) { $faq->delete(); return back()->with('ok', 'FAQ dihapus.'); }
    private function faqData(Request $r) { return $r->validate(['pertanyaan'=>'required|string','jawaban'=>'required|string','urutan'=>'nullable|integer|min:0','aktif'=>'nullable']) + ['urutan'=>$r->input('urutan',0),'aktif'=>$r->boolean('aktif')]; }

    // --- Testimoni ---
    public function testimoniIndex() { return view('admin.home.testimoni-index', ['items' => Testimoni::orderBy('urutan')->orderBy('id')->get()]); }
    public function testimoniCreate() { return view('admin.home.testimoni-form', ['item' => new Testimoni()]); }
    public function testimoniStore(Request $r) { Testimoni::create($this->testimoniData($r)); return redirect()->route('admin.testimoni.index')->with('ok', 'Testimoni ditambahkan.'); }
    public function testimoniEdit(Testimoni $testimoni) { return view('admin.home.testimoni-form', ['item' => $testimoni]); }
    public function testimoniUpdate(Request $r, Testimoni $testimoni) { $testimoni->update($this->testimoniData($r)); return redirect()->route('admin.testimoni.index')->with('ok', 'Testimoni diperbarui.'); }
    public function testimoniDestroy(Testimoni $testimoni) { $testimoni->delete(); return back()->with('ok', 'Testimoni dihapus.'); }
    private function testimoniData(Request $r) { return $r->validate(['inisial'=>'nullable|string|max:10','nama'=>'required|string|max:255','jabatan'=>'nullable|string|max:255','teks'=>'required|string','urutan'=>'nullable|integer|min:0','aktif'=>'nullable']) + ['urutan'=>$r->input('urutan',0),'aktif'=>$r->boolean('aktif')]; }

    // --- Mitra ---
    public function mitraIndex() { return view('admin.home.mitra-index', ['items' => Mitra::orderBy('urutan')->orderBy('id')->get()]); }
    public function mitraCreate() { return view('admin.home.mitra-form', ['item' => new Mitra()]); }
    public function mitraStore(Request $r) { Mitra::create($this->mitraData($r)); return redirect()->route('admin.mitra.index')->with('ok', 'Mitra ditambahkan.'); }
    public function mitraEdit(Mitra $mitra) { return view('admin.home.mitra-form', ['item' => $mitra]); }
    public function mitraUpdate(Request $r, Mitra $mitra) { $mitra->update($this->mitraData($r)); return redirect()->route('admin.mitra.index')->with('ok', 'Mitra diperbarui.'); }
    public function mitraDestroy(Mitra $mitra) { $mitra->delete(); return back()->with('ok', 'Mitra dihapus.'); }
    private function mitraData(Request $r) {
        $existing = $r->route('mitra')?->logo;
        $data = $r->validate([
            'nama'=>'required|string|max:255',
            'logo'=>[Rule::requiredIf(!$existing && !$r->hasFile('logo_file')), 'nullable','string','max:255'],
            'logo_file'=>[Rule::requiredIf(!$existing && !$r->filled('logo')), 'nullable','image','max:4096'],
            'urutan'=>'nullable|integer|min:0',
            'aktif'=>'nullable',
        ]);
        $data['logo'] = $this->resolveImage($r, 'logo_file', $r->input('logo'), $existing);
        $data['urutan'] = $r->input('urutan',0); $data['aktif'] = $r->boolean('aktif');
        unset($data['logo_file']);
        return $data;
    }

    // --- Langkah Galeri ---
    public function langkahGaleriIndex() { return view('admin.home.langkah-galeri-index', ['items' => LangkahGaleri::orderBy('urutan')->orderBy('id')->get()]); }
    public function langkahGaleriCreate() { return view('admin.home.langkah-galeri-form', ['item' => new LangkahGaleri()]); }
    public function langkahGaleriStore(Request $r) { LangkahGaleri::create($this->langkahGaleriData($r)); return redirect()->route('admin.langkah-galeri.index')->with('ok', 'Item galeri ditambahkan.'); }
    public function langkahGaleriEdit(LangkahGaleri $langkahGaleri) { return view('admin.home.langkah-galeri-form', ['item' => $langkahGaleri]); }
    public function langkahGaleriUpdate(Request $r, LangkahGaleri $langkahGaleri) { $langkahGaleri->update($this->langkahGaleriData($r)); return redirect()->route('admin.langkah-galeri.index')->with('ok', 'Item galeri diperbarui.'); }
    public function langkahGaleriDestroy(LangkahGaleri $langkahGaleri) { $langkahGaleri->delete(); return back()->with('ok', 'Item galeri dihapus.'); }
    private function langkahGaleriData(Request $r) { return $r->validate(['judul'=>'required|string|max:255','subjudul'=>'nullable|string|max:255','url'=>'required|string|max:1000','label_tombol'=>'nullable|string|max:50','urutan'=>'nullable|integer|min:0','aktif'=>'nullable']) + ['urutan'=>$r->input('urutan',0),'aktif'=>$r->boolean('aktif'),'label_tombol'=>$r->input('label_tombol','Lihat')]; }

    // --- Langkah Publikasi ---
    public function langkahPublikasiIndex() { return view('admin.home.langkah-publikasi-index', ['items' => LangkahPublikasi::orderBy('urutan')->orderBy('id')->get()]); }
    public function langkahPublikasiCreate() { return view('admin.home.langkah-publikasi-form', ['item' => new LangkahPublikasi()]); }
    public function langkahPublikasiStore(Request $r) { LangkahPublikasi::create($this->langkahPublikasiData($r)); return redirect()->route('admin.langkah-publikasi.index')->with('ok', 'Publikasi ditambahkan.'); }
    public function langkahPublikasiEdit(LangkahPublikasi $langkahPublikasi) { return view('admin.home.langkah-publikasi-form', ['item' => $langkahPublikasi]); }
    public function langkahPublikasiUpdate(Request $r, LangkahPublikasi $langkahPublikasi) { $langkahPublikasi->update($this->langkahPublikasiData($r)); return redirect()->route('admin.langkah-publikasi.index')->with('ok', 'Publikasi diperbarui.'); }
    public function langkahPublikasiDestroy(LangkahPublikasi $langkahPublikasi) { $langkahPublikasi->delete(); return back()->with('ok', 'Publikasi dihapus.'); }
    private function langkahPublikasiData(Request $r) { return $r->validate(['judul'=>'required|string','url'=>'required|string|max:1000','label_tombol'=>'nullable|string|max:50','urutan'=>'nullable|integer|min:0','aktif'=>'nullable']) + ['urutan'=>$r->input('urutan',0),'aktif'=>$r->boolean('aktif'),'label_tombol'=>$r->input('label_tombol','Lihat')]; }

    // --- Langkah Dokumentasi ---
    public function langkahDokumentasiIndex() { return view('admin.home.langkah-dokumentasi-index', ['items' => LangkahDokumentasi::orderBy('urutan')->orderBy('id')->get()]); }
    public function langkahDokumentasiCreate() { return view('admin.home.langkah-dokumentasi-form', ['item' => new LangkahDokumentasi()]); }
    public function langkahDokumentasiStore(Request $r) { LangkahDokumentasi::create($this->langkahDokumentasiData($r)); return redirect()->route('admin.langkah-dokumentasi.index')->with('ok', 'Dokumentasi ditambahkan.'); }
    public function langkahDokumentasiEdit(LangkahDokumentasi $langkahDokumentasi) { return view('admin.home.langkah-dokumentasi-form', ['item' => $langkahDokumentasi]); }
    public function langkahDokumentasiUpdate(Request $r, LangkahDokumentasi $langkahDokumentasi) { $langkahDokumentasi->update($this->langkahDokumentasiData($r)); return redirect()->route('admin.langkah-dokumentasi.index')->with('ok', 'Dokumentasi diperbarui.'); }
    public function langkahDokumentasiDestroy(LangkahDokumentasi $langkahDokumentasi) { $langkahDokumentasi->delete(); return back()->with('ok', 'Dokumentasi dihapus.'); }
    private function langkahDokumentasiData(Request $r) {
        $existing = $r->route('langkahDokumentasi')?->gambar;
        $data = $r->validate([
            'gambar'=>[Rule::requiredIf(!$existing && !$r->hasFile('gambar_file')), 'nullable','string','max:255'],
            'gambar_file'=>[Rule::requiredIf(!$existing && !$r->filled('gambar')), 'nullable','image','max:4096'],
            'alt'=>'required|string|max:255',
            'kelas'=>'nullable|string|max:50',
            'urutan'=>'nullable|integer|min:0',
            'aktif'=>'nullable',
        ]);
        $data['gambar'] = $this->resolveImage($r, 'gambar_file', $r->input('gambar'), $existing);
        $data['urutan'] = $r->input('urutan',0); $data['aktif'] = $r->boolean('aktif');
        unset($data['gambar_file']);
        return $data;
    }

    // --- Berita ---
    public function beritaIndex() { return view('admin.selasar.berita-index', ['items' => Berita::orderBy('urutan')->orderByDesc('id')->get()]); }
    public function beritaCreate() { return view('admin.selasar.berita-form', ['item' => new Berita()]); }
    public function beritaStore(Request $r) { Berita::create($this->beritaData($r)); return redirect()->route('admin.berita.index')->with('ok', 'Berita ditambahkan.'); }
    public function beritaEdit(Berita $berita) { return view('admin.selasar.berita-form', ['item' => $berita]); }
    public function beritaUpdate(Request $r, Berita $berita) { $berita->update($this->beritaData($r)); return redirect()->route('admin.berita.index')->with('ok', 'Berita diperbarui.'); }
    public function beritaDestroy(Berita $berita) { $berita->delete(); return back()->with('ok', 'Berita dihapus.'); }
    private function beritaData(Request $r) {
        $existing = $r->route('berita')?->gambar;
        $data = $r->validate([
            'judul'=>'required|string|max:255',
            'excerpt'=>'required|string',
            'gambar'=>[Rule::requiredIf(!$existing && !$r->hasFile('gambar_file')), 'nullable','string','max:255'],
            'gambar_file'=>[Rule::requiredIf(!$existing && !$r->filled('gambar')), 'nullable','image','max:4096'],
            'url'=>'required|string|max:1000',
            'urutan'=>'nullable|integer|min:0',
            'aktif'=>'nullable',
        ]);
        $data['gambar'] = $this->resolveImage($r, 'gambar_file', $r->input('gambar'), $existing);
        $data['urutan'] = $r->input('urutan',0); $data['aktif'] = $r->boolean('aktif');
        unset($data['gambar_file']);
        return $data;
    }

    // --- Toko Produk ---
    public function tokoIndex() { return view('admin.selasar.toko-index', ['items' => TokoProduk::orderBy('urutan')->orderBy('id')->get()]); }
    public function tokoCreate() { return view('admin.selasar.toko-form', ['item' => new TokoProduk()]); }
    public function tokoStore(Request $r) { TokoProduk::create($this->tokoData($r)); return redirect()->route('admin.toko.index')->with('ok', 'Produk ditambahkan.'); }
    public function tokoEdit(TokoProduk $tokoProduk) { return view('admin.selasar.toko-form', ['item' => $tokoProduk]); }
    public function tokoUpdate(Request $r, TokoProduk $tokoProduk) { $tokoProduk->update($this->tokoData($r)); return redirect()->route('admin.toko.index')->with('ok', 'Produk diperbarui.'); }
    public function tokoDestroy(TokoProduk $tokoProduk) { $tokoProduk->delete(); return back()->with('ok', 'Produk dihapus.'); }
    private function tokoData(Request $r) {
        $existing = $r->route('tokoProduk')?->gambar;
        $data = $r->validate([
            'judul'=>'required|string|max:255',
            'detail_text'=>'nullable|string',
            'penulis'=>'required|string|max:255',
            'harga'=>'required|string|max:100',
            'gambar'=>[Rule::requiredIf(!$existing && !$r->hasFile('gambar_file')), 'nullable','string','max:255'],
            'gambar_file'=>[Rule::requiredIf(!$existing && !$r->filled('gambar')), 'nullable','image','max:4096'],
            'urutan'=>'nullable|integer|min:0',
            'aktif'=>'nullable',
        ]);
        $detail = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', (string) $r->input('detail_text')))));
        $data['detail'] = $detail;
        $data['gambar'] = $this->resolveImage($r, 'gambar_file', $r->input('gambar'), $existing);
        $data['urutan'] = $r->input('urutan',0); $data['aktif'] = $r->boolean('aktif');
        unset($data['gambar_file'], $data['detail_text']);
        return $data;
    }

    // --- Agenda ---
    public function agendaIndex() { return view('admin.jelajah.agenda-index', ['items' => Agenda::orderBy('bulan')->orderBy('urutan')->get()]); }
    public function agendaCreate() { return view('admin.jelajah.agenda-form', ['item' => new Agenda()]); }
    public function agendaStore(Request $r) { Agenda::create($this->agendaData($r)); return redirect()->route('admin.agenda.index')->with('ok', 'Agenda ditambahkan.'); }
    public function agendaEdit(Agenda $agenda) { return view('admin.jelajah.agenda-form', ['item' => $agenda]); }
    public function agendaUpdate(Request $r, Agenda $agenda) { $agenda->update($this->agendaData($r)); return redirect()->route('admin.agenda.index')->with('ok', 'Agenda diperbarui.'); }
    public function agendaDestroy(Agenda $agenda) { $agenda->delete(); return back()->with('ok', 'Agenda dihapus.'); }
    private function agendaData(Request $r) { return $r->validate(['bulan'=>'required|integer|min:1|max:12','kategori'=>'required|string|max:255','nama'=>'required|string|max:255','tanggal_label'=>'required|string|max:255','deskripsi'=>'required|string','urutan'=>'nullable|integer|min:0']) + ['urutan'=>$r->input('urutan',0)]; }

    // --- Destinasi ---
    public function destinasiIndex() { return view('admin.jelajah.destinasi-index', ['items' => Destinasi::orderBy('urutan')->orderBy('id')->get()]); }
    public function destinasiCreate() { return view('admin.jelajah.destinasi-form', ['item' => new Destinasi()]); }
    public function destinasiStore(Request $r) { Destinasi::create($this->destinasiData($r)); return redirect()->route('admin.destinasi.index')->with('ok', 'Destinasi ditambahkan.'); }
    public function destinasiEdit(Destinasi $destinasi) { return view('admin.jelajah.destinasi-form', ['item' => $destinasi]); }
    public function destinasiUpdate(Request $r, Destinasi $destinasi) { $destinasi->update($this->destinasiData($r)); return redirect()->route('admin.destinasi.index')->with('ok', 'Destinasi diperbarui.'); }
    public function destinasiDestroy(Destinasi $destinasi) { $destinasi->delete(); return back()->with('ok', 'Destinasi dihapus.'); }
    private function destinasiData(Request $r) {
        $existing = $r->route('destinasi')?->gambar;
        $data = $r->validate([
            'nama'=>'required|string|max:255',
            'slug'=>'nullable|string|max:255',
            'daerah'=>'required|string|max:255',
            'deskripsi'=>'required|string',
            'gambar'=>[Rule::requiredIf(!$existing && !$r->hasFile('gambar_file')), 'nullable','string','max:255'],
            'gambar_file'=>[Rule::requiredIf(!$existing && !$r->filled('gambar')), 'nullable','image','max:4096'],
            'tour_url'=>'nullable|string|max:1000',
            'urutan'=>'nullable|integer|min:0',
            'aktif'=>'nullable',
        ]);
        $data['gambar'] = $this->resolveImage($r, 'gambar_file', $r->input('gambar'), $existing);
        $data['urutan'] = $r->input('urutan',0); $data['aktif'] = $r->boolean('aktif');
        unset($data['gambar_file']);
        return $data;
    }

    // --- Users ---
    public function userIndex() { return view('admin.users.index', ['items' => User::orderByDesc('id')->get()]); }
    public function userCreate() { return view('admin.users.form', ['item' => new User()]); }
    public function userStore(Request $r) {
        $data = $r->validate(['name'=>'required|string|max:255','email'=>'required|email|max:255|unique:users,email','password'=>'required|string|min:8','role'=>'required|in:siswa,guru,umkm,admin','sekolah'=>'nullable|string|max:255','kelas'=>'nullable|string|max:255']);
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return redirect()->route('admin.users.index')->with('ok', 'User ditambahkan.');
    }
    public function userEdit(User $user) { return view('admin.users.form', ['item' => $user]); }
    public function userUpdate(Request $r, User $user) {
        $data = $r->validate(['name'=>'required|string|max:255','email'=>['required','email','max:255', Rule::unique('users','email')->ignore($user->id)],'password'=>'nullable|string|min:8','role'=>'required|in:siswa,guru,umkm,admin','sekolah'=>'nullable|string|max:255','kelas'=>'nullable|string|max:255']);
        if (!empty($data['password'])) $data['password'] = Hash::make($data['password']); else unset($data['password']);
        $user->update($data);
        return redirect()->route('admin.users.index')->with('ok', 'User diperbarui.');
    }
    public function userDestroy(User $user) {
        if ($user->id === auth()->id()) return back()->with('err', 'Tidak bisa menghapus akun sendiri.');
        $user->delete();
        return back()->with('ok', 'User dihapus.');
    }

    private function resolveImage(Request $r, string $fileKey, ?string $pathInput, ?string $existing): ?string
    {
        if ($r->hasFile($fileKey)) {
            $file = $r->file($fileKey);
            $dir = public_path('assets/uploads/admin');
            if (!is_dir($dir)) mkdir($dir, 0775, true);
            $name = time().'_'.preg_replace('/[^a-zA-Z0-9._-]/','_', $file->getClientOriginalName());
            $file->move($dir, $name);
            return 'assets/uploads/admin/'.$name;
        }
        return $pathInput ?: $existing;
    }
}
