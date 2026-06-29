@props(['title' => 'Admin'])

@include('layouts.dashboard', ['title' => $title, 'slot' => $slot, 'header' => $header ?? null])
