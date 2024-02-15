# Laravel JSON

Laravel JSON is a helper suite developed to make working with JSON datasets in Laravel more streamlined.

## Get Started

> **Requires [PHP 8.2+](https://php.net/releases/)**

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