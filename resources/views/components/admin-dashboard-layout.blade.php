@props(['title' => 'Admin'])

@include('layouts.admin-dashboard', ['title' => $title, 'slot' => $slot, 'header' => $header ?? null])
