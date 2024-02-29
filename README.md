<p align="center"><img src="https://raw.githubusercontent.com/iteks/art/master/logo-packages/laravel-json.svg" width="400" alt="Laravel JSON"></p>

<p align="center">
<a href="https://packagist.org/packages/iteks/laravel-json"><img src="https://img.shields.io/packagist/dt/iteks/laravel-json" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/iteks/laravel-json"><img src="https://img.shields.io/packagist/v/iteks/laravel-json" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/iteks/laravel-json"><img src="https://img.shields.io/packagist/l/iteks/laravel-json" alt="License"></a>
</p>

The `laravel-json` package, offered by iteks, streamlines JSON data manipulation in Laravel, enabling effortless conversion of JSON to Laravel Collections or arrays. Tailored for Laravel developers who prioritize efficient JSON data handling, it supports PHP 8.1+ and integrates seamlessly via Composer. This utility is essential for projects that demand advanced JSON data processing. For a detailed guide on installation and usage, explore the GitHub repository. Developed by <a href="https://github.com/jeramyhing">jeramyhing</a>.

## Get Started

> **Requires [PHP 8.1+](https://php.net/releases/)**

Install Laravel JSON via the [Composer](https://getcomposer.org/) package manager:

```bash
composer require iteks/laravel-json
```

## Usage

- [Sample JSON Dataset](#sample-json-dataset)
- [toCollection()](#tocollection)
- [toArray()](#toarray)

### Sample Json Dataset

```json
// test.json

[
    {
        "border": "3px solid white",
        "coordinates": [
          51.70696,
          40.34103
        ],
        "password": "xXeagle-*******"
    },
    {
        "border": "1px dotted amber",
        "coordinates": [
          11.80583,
          108.05094
        ],
        "password": "xXmeerkat-******"
    },
    {
        "border": "4px dotted gray",
        "coordinates": [
          116.82882,
          74.57905
        ],
        "password": "xXcat-*******"
    }
]
```

### toCollection

`toCollection(string $path, ?string $attribute = null): Collection`

Create a nested Collection from the given JSON file containing an array of objects.

```php
$data = Json::toCollection(database_path('data/test.json'));
```

Returns:

```sh
Illuminate\Support\Collection {#298 ▼
  #items: array:3 [▼
    0 => 
Illuminate\Support\Collection {#299 ▼
      #items: array:3 [▼
        "border" => "3px solid white"
        "coordinates" => array:2 [▼
          0 => 51.70696
          1 => 40.34103
        ]
        "password" => "xXeagle-*******"
      ]
      #escapeWhenCastingToString: false
    }
    1 => 
Illuminate\Support\Collection {#300 ▼
      #items: array:3 [▼
        "border" => "1px dotted amber"
        "coordinates" => array:2 [▼
          0 => 11.80583
          1 => 108.05094
        ]
        "password" => "xXmeerkat-******"
      ]
      #escapeWhenCastingToString: false
    }
    2 => 
Illuminate\Support\Collection {#301 ▼
      #items: array:3 [▼
        "border" => "4px dotted gray"
        "coordinates" => array:2 [▼
          0 => 116.82882
          1 => 74.57905
        ]
        "password" => "xXcat-*******"
      ]
      #escapeWhenCastingToString: false
    }
  ]
  #escapeWhenCastingToString: false
}
```

Get a collection containing just the values of a given attribute.

```php
$data = Json::toCollection(database_path('data/test.json'), 'border');
```

Returns:

```sh
Illuminate\Support\Collection {#297 ▼
  #items: array:3 [▼
    0 => "3px solid white"
    1 => "1px dotted amber"
    2 => "4px dotted gray"
  ]
  #escapeWhenCastingToString: false
}
```

### toArray

`toArray(string $path, ?string $attribute = null): array`

Create a nested associative array from the given JSON file containing an array of objects.

```php
$data = Json::toArray(database_path('data/test.json'));
```

Returns:


```sh
array:3 [▼
  0 => array:3 [▼
    "border" => "3px solid white"
    "coordinates" => array:2 [▼
      0 => 51.70696
      1 => 40.34103
    ]
    "password" => "xXeagle-*******"
  ]
  1 => array:3 [▼
    "border" => "1px dotted amber"
    "coordinates" => array:2 [▼
      0 => 11.80583
      1 => 108.05094
    ]
    "password" => "xXmeerkat-******"
  ]
  2 => array:3 [▼
    "border" => "4px dotted gray"
    "coordinates" => array:2 [▼
      0 => 116.82882
      1 => 74.57905
    ]
    "password" => "xXcat-*******"
  ]
]
```

Get an array containing just the values of a given attribute.

```php
$data = Json::toArray(database_path('data/test.json'), 'border');
```

Returns:

```sh
array:3 [▼
  0 => "3px solid white"
  1 => "1px dotted amber"
  2 => "4px dotted gray"
]
```