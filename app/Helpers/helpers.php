<?php

use Illuminate\Support\Carbon;

function setActive($routeName)
{
    return request()->routeIs($routeName) ? 'bg-white text-link-active' : '';
}

// function getRuleUser($role)
// {
//     $rules = [
//         'SUPER_ADMIN' => 'Super administrador',
//         'ADMIN' => 'Administrador',
//         'COLLABORATOR' => 'Colaborador',
//     ];

//     return $rules[$role];
// }

function getGenderChar($gender)
{
    return match ($gender) {
        'hombre' => 'h',
        'mujer' => 'm',
        default => 'h'
    };
}

function getGenderName($gender)
{
    return match ($gender) {
        'h' => 'Hombre',
        'm' => 'Mujer',
        default => 'Hombre'
    };
}

function getGenderNameMin($gender)
{
    return match ($gender) {
        'h' => 'hombre',
        'm' => 'mujer',
        default => 'hombre'
    };
}

function getRoleName($role)
{
    return match ($role) {
        'admin' => 'Administrador',
        'doctor' => 'Doctor',
        'receptionist' => 'Recepcionista',
        default => '-'
    };
}

function verifyImage($file)
{
    $url = asset('images/clinic/no-image.png');
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
    return 'https://ui-avatars.com/api/?name=' . urlencode($user->names) . '&color=2452d1&background=f4f4f4';
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
