<?php

namespace App\Http\Controllers;

class HelperPathController extends Controller {
    private function generateResultados(): array {
        $resultados                          = [];
        $descricao                           = [];
        $resultados['APP_PATH']['resultado'] = app_path();
        $descricao['APP_PATH']               = 'Pasta onde fica a aplicação propriamente dita. Local onde fica as models, controllers,
        middleware, etc.';
        $resultados['APP_PATH']['Http/Controllers/HelperPathController.php'] = app_path('Http/Controllers/HelperPathController.php');
        $resultados['BASE_PATH']['resultado']                                = base_path();
        $resultados['BASE_PATH']['dockerfile']                               = base_path('vendor/laravel/sail/runtimes/8.1/Dockerfile');
        $resultados['CONFIG_PATH']['resultado']                              = config_path();
        $resultados['DATABASE_PATH']['resultado']                            = database_path();
        $resultados['LANG_PATH']['resultado']                                = lang_path();

        /** Só funciona se existir o Laravel Mix na aplicação */
        // $resultados[] = mix('css/app.css');

        $resultados['PUBLIC_PATH']['resultado']   = public_path();
        $resultados['RESOURCE_PATH']['resultado'] = resource_path();
        $resultados['STORAGE_PATH']['resultado']  = storage_path();

        return [$resultados, $descricao];
    }

    public function index() {
        [$resultados, $descricao] = $this->generateResultados();

        return view('pages.helpers.path', compact('resultados', 'descricao'));
    }

    public function indexDD() {
        [$resultados, $descricao] = $this->generateResultados();
        dd($resultados, $descricao);
    }
}
