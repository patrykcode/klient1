<?php

return [
    /*
      |--------------------------------------------------------------------------
      |  Menu list
      |--------------------------------------------------------------------------
     */

    'menu' => [
        'start' => 'Dashboard',
        'Ustawienia' => [
            'user' => ['Użytkownicy', 'user.read'],
//          'settings' => ['Ustawienia', 'settings.read'],
        ],
        'Treści' => [
            'articles' => ['Podstrony', 'articles.read'],
            'news' => ['Aktualności', 'news.read'],
            'galleries' => ['Galerie', 'galleries.read'],
            'sliders' => ['Slajdery', 'sliders.read'],
        ],
        'Moduly' => [
            'persons' => ['Zgłoszenia', 'persons.read'],
        ],
        'logout' => 'Wyloguj się',
    ]
];
