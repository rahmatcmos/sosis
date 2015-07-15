<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Input;

use App\SentItem;

class SentItemController extends Controller
{
    /**
     * Menampilkan daftar sms di sentitem.
     */
    public function index()
    {
        // Ambil data filter dan sorting
        $sort = Input::get('sort', 'SendingDateTime');
        $mode = Input::get('mode', 'desc');
        $cari = Input::get('cari', '');
        $cari_bulan = Input::get('cari_bulan', '');

        $sentitem_all = SentItem::
              leftJoin('contact', 'sentitems.DestinationNumber', 'like', 'contact.ponsel')
            ->where('TextDecoded', 'like', "%$cari%")
            ->where('SendingDateTime', 'like', "$cari_bulan%")
            ->orderBy($sort, $mode)
            ->paginate(7);

        return view('sentitem.index', compact('sentitem_all', 'sort', 'mode', 'cari', 'cari_bulan'));
    }

    /**
     * Mengapus data sms terpilih dari sentitem.
     */
    public function delete($id)
    {
        $sentitem = SentItem::destroy($id);

        return redirect()->back()
            ->with('infoMessage', 'Pesan telah dihapus');
    }
}
