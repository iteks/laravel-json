<p align="center"><img src="https://raw.githubusercontent.com/iteks/art/master/logo-packages/laravel-json.svg" width="400" alt="Laravel JSON"></p>

<p align="center">
<a href="https://packagist.org/packages/iteks/laravel-json"><img src="https://img.shields.io/packagist/dt/iteks/laravel-json" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/iteks/laravel-json"><img src="https://img.shields.io/packagist/v/iteks/laravel-json" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/iteks/laravel-json"><img src="https://img.shields.io/packagist/l/iteks/laravel-json" alt="License"></a>
</p>

The **Laravel JSON** package is a powerful and versatile tool designed to enhance the handling of JSON data within Laravel applications. With its intuitive API, developers can effortlessly convert JSON files into Laravel collections or associative arrays, facilitating easy data manipulation and access. Whether you're dealing with configuration files, dataset imports, or any JSON-formatted data source, this package simplifies the process, allowing you to focus on building feature-rich applications. Built with flexibility in mind, it supports optional attribute filtering, enabling precise data retrieval tailored to your needs. Perfect for projects of all sizes, **Laravel JSON** aims to streamline your development workflow, making JSON data handling a breeze. Offered by <a href="https://github.com/iteks/laravel-json">iteks</a>, Developed by <a href="https://github.com/jeramyhing">jeramyhing</a>.

## Get Started

> **Requires [PHP 8.1+](https://php.net/releases/)**

Install Laravel JSON via the [Composer](https://getcomposer.org/) package manager:

```bash
composer require iteks/laravel-json
```

## Usage

- [Sample JSON Dataset](#sample-json-dataset)
- [JSON Helpers](#json-helpers)
  - [Json::toCollection()](#jsontocollection)
  - [Json::toArray()](#jsontoarray)

## Sample Json Dataset

```json
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

[top](#usage)

## JSON Helpers

First, import the helper class:

```php
use Iteks\Support\Facades\Json;
```

You may then use the following methods:

[top](#usage)

### Json::toCollection()

The `toCollection` method converts a JSON file into a Laravel collection of collections. This is particularly useful when you need to manipulate JSON data with the convenience and power of Laravel's Collection methods.

#### Without Argument Usage

When you use toCollection without specifying an attribute, it will simply convert the entire JSON file into a collection where each element is itself a collection representing the JSON objects.

```php
$collection = Json::toCollection(database_path('data/test.json'));
```

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

```php
// Iterate over the collection
foreach ($collection as $item) {
    // Access properties like in any Laravel collection
    echo $item->get('border');
}
```

#### With Argument Usage

When you provide an attribute name as the second argument, toCollection will create a collection where each item is the value of the specified attribute from the JSON objects.

```php
$collection = Json::toCollection(database_path('data/test.json'), 'border');
```

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

[top](#usage)

### Json::toArray()

The `toArray` method converts a JSON file into a PHP array. This method is ideal for when you need a simple array representation of your JSON data for further processing or when Laravel's Collection methods are not necessary.

#### Without Argument Usage

Without specifying an attribute, toArray converts the entire JSON file into a nested array, with each element being an associative array representing the JSON objects.

```php
$array = Json::toArray(database_path('data/test.json'));
```

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

```php
// Access the array directly
foreach ($array as $item) {
    echo $item['border'];
}
```

#### With Argument Usage

Providing an attribute name as the second argument, toArray will generate an array containing only the values of the specified attribute from each JSON object.

```php
$array = Json::toArray(database_path('data/test.json'), 'border');
```

```sh
array:3 [▼
  0 => "3px solid white"
  1 => "1px dotted amber"
  2 => "4px dotted gray"
]
```

[top](#usage)
