<?php

use Illuminate\Support\Carbon;

function setActive($routeName)
{
    return request()->routeIs($routeName) ? 'bg-white text-link-active shadow-lg' : '';
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

function getBadgeStatusBlade($status)
{
    return match ($status) {
        'approved' => '<x-badge positive label="Aprovado"/>',
        'pending' => '<x-badge warning label="Pendiente"/>',
        'rejected' => '<x-badge negative label="Rechazado"/>',
        default => '<x-badge info label="Desconocido"/>'
    };
}

function getRoutePatientShow($dish)
{
    $user = auth()->user();

    $route = match ($user->role) {
        'admin' => 'admin.patients.show',
        'doctor' => 'doctor.patients.show',
        'receptionist' => 'receptionist.patients.show',
    };

    return route($route, $dish);
}



function verifyAvatar($file)
{
    $user = auth()->user();
    if ($file) {
        return $file->file_url;
    }
    return 'https://ui-avatars.com/api/?name=' . urlencode($user->names) . '&color=0284c7&background=ffffff';
}

function verifyMultipleAvatar($file, $names)
{
    if ($file) {
        return $file->file_url;
    }
    return 'https://ui-avatars.com/api/?name=' . urlencode($names) . '&color=0284c7&background=ffffff';
}

function getRouteDashboard()
{
    $user = auth()->user();
    return match ($user->role) {
        'admin' => 'admin.dashboard',
        'doctor' => 'doctor.dashboard',
        'receptionist' => 'receptionist.dashboard',
    };
}

function formatTimeHs($time)
{
    return Carbon::parse($time)->format('H:i');
}

function getLabelScheduleHour($schedule)
{
    return formatTimeHs($schedule->start)  . " a " . formatTimeHs($schedule->end);
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
