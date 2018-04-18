
# Mercado Pago SDK 0.5.2 for Laravel 5
Este paquete es una version actualizada al dia 18/04/2018 y de la version creada por [livelpixel](https://github.com/livepixel/)

* [Instalar](#install)
* [Configurando](#config)
* [Como usar](#how-to)
* [Mais informcion](#info)

<a name="install"></a>
### Instalar

`composer require enlinealab/mercado-pago`

En su archivo `config/app.php` agregue:

```php
'providers' => [

    /*
     * Laravel Framework Service Providers...
     */

    'EnlineaLab\MercadoPago\Providers\MercadoPagoServiceProvider',
],
``` 

Tambien puede crear un `alias`:

```php
'aliases' => [
    // Otros alias 

    'MP' => 'EnlineaLab\MercadoPago\Facades\MP',
]
```

<a name="config"></a>
### Configurando

Antes de comezar a usar vamos publicar o archivoo de configuracion. 
En el directorio de su proyecto ejecute el siguiente comando:

`php artisan vendor:publish`

El comando anterior generará un archivo `config/mercadopago.php`. 
En este archivo debe agregar su App Id y App Secret. 
Para saber cuáles son sus claves ingrese a

* [Argentina](https://www.mercadopago.com/mla/herramientas/aplicaciones)
* [Brazil](https://www.mercadopago.com/mlb/ferramentas/aplicacoes)
* [Mexico](https://www.mercadopago.com/mlm/herramientas/aplicaciones)
* [Venezuela](https://www.mercadopago.com/mlv/herramientas/aplicaciones)
* [Colombia](https://www.mercadopago.com/mco/herramientas/aplicaciones)
* [Chile](https://www.mercadopago.com/mlc/herramientas/aplicaciones)
* [Uruguay](https://www.mercadopago.com/muy/herramientas/aplicaciones)


```php
return [
    'app_id'     => env('MP_APP_ID', 'SEU CLIENT ID'),
    'app_secret' => env('MP_APP_SECRET', 'SEU CLIENT SECRET')
];
```

Tambien pude configurarlo agregando las claves `MP_APP_ID` e `MP_APP_SECRET` en su archivo `.env` 

<a name="how-to"></a>
### Como usar

En este ejemplo, vamos a crear una preferencia de pago y luego redirigir al usuario a realizar el pago en el MercadoPago.

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Exception;
use MP;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $preference_data = array (
            "items" => array (
                array (
                    "title" => "Test2",
                    "quantity" => 1,
                    "currency_id" => "BRL",
                    "unit_price" => 10.41
                )
            )
        );

        try {
            $preference = MP::create_preference($preference_data);
            return redirect()->to($preference['response']['init_point']);
        } catch (Exception $e){
            dd($e->getMessage());
        }
    }
}
```

<a name="info"></a>
### Mas

Para más información acceda al sitio de [Mercado Pago para desarrolladores](https://developers.mercadopago.com/) y tambien a [repositório do SDK oficial](https://github.com/mercadopago/sdk-php)


### Agradecimientos
Espacial Gracias a [livelpixel](https://github.com/livepixel/) quien adpto el sdk en primer lugar.
