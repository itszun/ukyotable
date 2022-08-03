# Ukyo Table | Serve You Datatable Response

#### Description
`Ukyo Table` is appear to be a helpful package to handle your data for creating simple Datatable

####  Background
Handling datatable for many model is painful. You can do copy paste but is not adaptable for upgrading datatable feature if implmemented too many datatable. 

With my basic understanding and passion for making useful and save my time for developing feature, I will do my best to make this thing useful and good enough. So that I can boost my productivity and maybe other
## Installation

Simply run composer on your laravel project. >w<)>

```
composer require zunfuyuzora/ukyotable

```

## Usage/Examples

Set Model to extends for UkyoModel and add `UkyoGather()` method as eloquent query builder that will be used as reference for `Ukyo` to serve you.
```
// file: App/Models/Food

class Food extends UkyoModel {
    public function UkyoGather() {
        return self::query()
    }
}

```

Use on your controller that used for handling ajax request from datatable.
```
// file: App/Http/Controller/FoodController.php

public function list(Request $request) {
    $datatable = UkyoTable::from($request)->get(Food::class)
    return $datatable->getResponseArray();
}

```

On your jquery datatable instantion, define something like this
```
<script>
$(document).ready(function() {
    $('#table').DataTable({
        searching: true,
        lengthChange: true,
        columns: [
            { data: 'ukyoCounter' },
            { data: 'name' },
            { data: 'category' },
            { data: 'price' },
            { data: 'discount' },
        ]
    })
})
</script>
```
## FAQ

#### Is it stable?

Of course not! >w<)/) 

#### Need Help?

No need!! >w<)/)

