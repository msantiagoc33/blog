<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\NuevoPostCorreo;
use App\Models\User;

use Illuminate\Http\Request;

class MailController extends Controller
{
    public function index()
    {

        $mailData = [
            'from' => 'Manuel Santiago Cabeza',
            'title' => 'Correo del blog de los Riders',
            'body'  => 'Se ha creado un nuevo post en el blog.',

        ];

        // Mail::to('msantiagoc33@gmail.com')->send(new BroadcastMailable($mailData));
        $users = User::all();
        foreach ($users as $usuario) {
            // Mail::to($usuario->email)->send(new NuevoPostCorreo($mailData));
            Mail::to($usuario->email)->queue(new NuevoPostCorreo($mailData));
        }
    }
}
