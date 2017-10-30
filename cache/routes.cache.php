<?php return array (
  0 => 
  array (
    'GET' => 
    array (
      '/articulos' => 'route1',
      '/autores/' => 'route6',
    ),
    'POST' => 
    array (
      '/articulos' => 'route3',
      '/autores/' => 'route8',
    ),
    'PUT' => 
    array (
      '/autores/' => 'route9',
    ),
  ),
  1 => 
  array (
    'GET' => 
    array (
      0 => 
      array (
        'regex' => '~^(?|/hola/([^/]+)|/articulos/([^/]+)()|/autores/([^/]+)()())$~',
        'routeMap' => 
        array (
          2 => 
          array (
            0 => 'route0',
            1 => 
            array (
              'name' => 'name',
            ),
          ),
          3 => 
          array (
            0 => 'route2',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          4 => 
          array (
            0 => 'route7',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
        ),
      ),
    ),
    'DELETE' => 
    array (
      0 => 
      array (
        'regex' => '~^(?|/articulos/([^/]+)|/autores/([^/]+)())$~',
        'routeMap' => 
        array (
          2 => 
          array (
            0 => 'route4',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          3 => 
          array (
            0 => 'route10',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
        ),
      ),
    ),
    'PUT' => 
    array (
      0 => 
      array (
        'regex' => '~^(?|/articulos/([^/]+))$~',
        'routeMap' => 
        array (
          2 => 
          array (
            0 => 'route5',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
        ),
      ),
    ),
  ),
);