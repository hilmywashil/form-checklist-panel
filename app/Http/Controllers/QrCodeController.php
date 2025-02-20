<?php

namespace App\Http\Controllers;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function show()
    {
        $data = QrCode::size(512)
            ->format('png')
            ->errorCorrection('M')
            ->generate(
                'https://instagram.com/hilmywashil_',
            );

        return response($data)
            ->header('Content-type', 'image/png');
    }
}
