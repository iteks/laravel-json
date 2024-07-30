<p align="center"><img src="https://raw.githubusercontent.com/iteks/art/master/logo-packages/laravel-json.svg" width="400" alt="Laravel JSON"></p>

<p align="center">
<a href="https://packagist.org/packages/iteks/laravel-json"><img src="https://img.shields.io/packagist/dt/iteks/laravel-json" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/iteks/laravel-json"><img src="https://img.shields.io/packagist/v/iteks/laravel-json" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/iteks/laravel-json"><img src="https://img.shields.io/packagist/l/iteks/laravel-json" alt="License"></a>
</p>

The **Laravel JSON** package is a powerful and versatile tool designed to enhance the handling of JSON data within Laravel applications. With its intuitive API, developers can effortlessly convert JSON files into Laravel collections or associative arrays, facilitating easy data manipulation and access. Whether you're dealing with configuration files, dataset imports, or any JSON-formatted data source, this package simplifies the process, allowing you to focus on building feature-rich applications. Built with flexibility in mind, it supports optional attribute filtering, enabling precise data retrieval tailored to your needs. Additionally, enforce any JSON model column's data structure with column definitions, ensuring JSON data consistency with every interaction. Perfect for projects of all sizes, **Laravel JSON** aims to streamline your development workflow, making JSON data handling a breeze.

Offered by <a href="https://github.com/iteks/laravel-json">iteks</a>, Developed by <a href="https://github.com/jeramyhing">jeramyhing</a>.

## Get Started

> **Requires [PHP 8.1+](https://php.net/releases/)**

Install Laravel JSON via the [Composer](https://getcomposer.org/) package manager:

```bash
composer require iteks/laravel-json
```

## Usage

Include the Json facade.

```php
use Iteks\Support\Facades\Json;
```

- [Sample JSON Dataset](#sample-json-dataset)
- [JSON Helpers](#json-helpers)
  - [Json::toCollection()](#jsontocollection)
  - [Json::toArray()](#jsontoarray)
- [JSON Trait (DefinesJsonColumns)](#json-trait-definesjsoncolumns)
  - [Json::enforceDefinition()](#enforcedefinition)

## Sample Json Dataset

This JSON dataset is used in the [Json::toCollection()](#jsontocollection) and [Json::toArray()](#jsontoarray) method examples.

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

## JSON Trait (DefinesJsonColumns)

The `DefinesJsonColumns` trait and complementary `enforceDefinition` method allow you to define and enforce a JSON data structure for your JSON database columns. This ensures that any interaction with a JSON data column will consistently contain data that is structured according to its JSON definitions.

Simply apply the `DefinesJsonColumns` trait to your model that has JSON column(s) to define. Define the JSON structure with the `$jsonDefinitions` property on the model and begin using the `enforceDefinition` to enforce the column definition on your JSON input.

Import the model trait and configure your JSON definitions.

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Iteks\Support\Traits\DefinesJsonColumns;

class ExampleModel extends Model
{
  use DefinesJsonColumns;

  protected $jsonDefinitions = [
    'profile' => [
      'name' => 'string',
      'age' => 'integer',
      'avatar' => 'string',
    ],
    'address' => [
      'street' => 'string',
      'city' => 'string',
      'state' => 'string',
      'zip' => 'integer',
      'geo_coordinates' => 'array',
    ],
  ];
}
```

> You can configure definitions for multiple JSON columns.

### Json::enforceDefinition()

You can use the `enforceDefinition` method anywhere in your application logic with target JSON input that you intend to insert into your model's JSON column.

```php
$addressJson = json_encode($addressData);
$enforcedJson = Json::enforceDefinition(ExampleModel::class, 'address', $addressJson);

$exampleModel->address = $enforcedJson;
$exampleModel->save();
```

> If the input JSON is `null` or missing any defined keys, the definition will still be enforced by adding the missing keys with `null` values. If the input JSON contains additional key value pairs that are not in the JSON column definition, they will be excluded.

#### Usage in a form request's `prepareForValidation` method

Apply the `enforceDefinition` method on the target request attribute that contains the JSON input. Pass the model class, column, and request attribute's JSON value.

```php
namespace App\Http\Requests;

use App\Models\ExampleModel;
use Illuminate\Foundation\Http\FormRequest;
use Iteks\Support\Facades\Json;

class ExampleFormRequest extends FormRequest
{
    protected function prepareForValidation(): self
    {
        $this->merge([
            'request_attribute' => Json::enforceDefinition(ExampleModel::class, 'profile', $this->request_attribute),
        ]);

        return $this;
    }
}
```

[top](#usage)
