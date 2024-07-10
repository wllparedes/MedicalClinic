<?php

use Illuminate\Support\Carbon;


// function setActive($routeName)
// {
//     return request()->routeIs($routeName) ? 'bg-adp-secondary' : '';
// }

// function getRuleUser($role)
// {
//     $rules = [
//         'SUPER_ADMIN' => 'Super administrador',
//         'ADMIN' => 'Administrador',
//         'COLLABORATOR' => 'Colaborador',
//     ];

//     return $rules[$role];
// }

function verifyImage($file)
{
    $url = asset('images/latinos/no-image.png');
    if ($file) {
        $url = $file->file_url ?? $url;
    }

    return $url;
}


function verifyAvatar($file)
{
    $user = auth()->user();
    if ($file) {
        return $file->file_url;
    }
    return 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&color=092635&background=D9EAE8';
}

function verifyMultipleAvatar($file, $names)
{
    if ($file) {
        return $file->file_url;
    }
    return 'https://ui-avatars.com/api/?name=' . urlencode($names) . '&color=092635&background=D9EAE8';
}

function getRouteDashboard()
{
    $user = auth()->user();
    return match ($user->role->name) {
        'SUPER_ADMIN' => 'super-admin.dashboard',
        'ADMIN' => 'admin.dashboard',
        'COLLABORATOR' => 'collaborator.dashboard',
    };
}


// CARBON

function getDateFormatNow()
{
    return Carbon::now('America/Lima')->format('d/m/Y g:i A');
}

function getCurrentYear()
{
    return Carbon::now('America/Lima')->format('Y');
}

function getCurrentDateTime()
{
    return Carbon::now('America/Lima')->format('YYYY-MM-DD HH:mm');
}

function dateTimeForHumans($date)
{
    return Carbon::parse($date)->locale('es')->isoFormat('LL [a las] HH:mm');
}

function getDateForHumans($date)
{
    return Carbon::parse($date)->locale('es')->isoFormat('DD [de] MMMM [del] YYYY');
}
