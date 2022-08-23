<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use stdClass;

class HelperArrayController extends Controller
{
    public function index():View{
        $resultados = [];
        $descricao = [];

        /** @property Arr::accessible */
        # O método Arr::accessible determina se o valor fornecido é acessível à matriz
        $descricao["Accessible"] = "O método Arr::accessible determina se o valor fornecido é acessível à matriz";
        $resultados["Accessible"]["array_a_b"] = Arr::accessible(['a' => 1, 'b' => 2]) ? "sim": "não";//true
        $resultados["Accessible"]["collection"] = Arr::accessible(new Collection()) ? "sim": "não";//true
        $resultados["Accessible"]["string_abc"] = Arr::accessible('abc') ? "sim": "não";//false
        $resultados["Accessible"]["stdClass"] = Arr::accessible(new stdClass) ? "sim": "não";//false
        $resultados["Accessible"]["objeto"] = Arr::accessible((object) []) ? "sim": "não";//false

        /** @property Arr::add */
        # O método Arr::add adiciona um determinado par de chave/valor a uma matriz se a chave fornecida ainda não existir
        # na matriz ou estiver definida como null:
        $descricao["Add"] = "O método Arr::add adiciona um determinado par de chave/valor a uma matriz se a chave
        fornecida ainda não existir na matriz ou estiver definida como null";
        $array = ['nome' => 'Urnau'];
        $resultados["Add"]["add_canal_dev_tech"] = $array = Arr::add($array, 'canal', "Dev Tech Tips Brasil");
        $resultados["Add"]["add_canal_aleatorio"] = $array = Arr::add($array, 'canal', "Canal Aleatório");
        $array['canal'] = null;
        $resultados["Add"]["canal_null"] = $array['canal'] === null ? "sim": "não";
        $resultados["Add"]["add_canal_brasil"] = $array = Arr::add($array, 'canal', "Canal Brasil");


        /** @property Arr::collapse */
        # O método Arr::collapse recolhe um array de arrays em um único array:
        $descricao["Collapse"] = "O método Arr::collapse recolhe um array de arrays em um único array";
        $resultados["Collapse"]['mesclar_arrays'] = Arr::collapse([[1, 2, 3], [4, 6], [9], [1,2,3,4,5]]);


        /** @property Arr::crossJoin */
        # O método Arr::crossJoin cross junta as matrizes fornecidas, retornando um produto cartesiano com todas as
        # permutações possíveis:
        $descricao["CrossJoin"] = "O método Arr::crossJoin cross junta as matrizes fornecidas, retornando um produto
        cartesiano com todas as permutações possíveis";
        $resultados["CrossJoin"]['matriz1'] = Arr::crossJoin([1, 2], ['a', 'b']);
        $resultados["CrossJoin"]['matriz2'] = Arr::crossJoin([1, 2], ['a', 'b'], ['I', 'II']);

        /** @property Arr::divide */
        #O método Arr::divide retorna dois arrays: um contendo as chaves e o outro contendo os valores do array dado:
        $descricao["Divide"] = "O método Arr::divide retorna dois arrays: um contendo as chaves e o outro contendo os
        valores do array dado";
        [$chaves, $valores] = Arr::divide(['nome' => 'Urnau', 'canal' => 'Dev Tech Tips Brasil']);
        $resultados["Divide"]['chaves'] = $chaves;
        $resultados["Divide"]['valores'] = $valores;

        /** @property Arr::dot */
        # O método Arr::dot nivela uma matriz multidimensional em uma matriz de nível único que usa a notação "ponto" para
        # indicar a profundidade:
        $descricao["Dot"] = "O método Arr::dot nivela uma matriz multidimensional em uma matriz de nível único que usa a
        notação 'ponto' para indicar a profundidade";
        $array = [
            'rede_sociais' => [
                'youtube' => [
                    'canal' => "Dev Tech Tips Brasil",
                    'inscritos' => 300
                ]
            ]
        ];
        $resultados["Dot"] = Arr::dot($array);

        /** @property Arr::except */
        # O método Arr::except remove os pares de chave/valor fornecidos de um array:
        $descricao["Except"] = "O método Arr::except remove os pares de chave/valor fornecidos de um array";
        $array = ['nome' => 'Urnau', 'canal' => 'Dev Tech Tips Brasil'];
        $resultados["Except"] = Arr::except($array, ['canal']);
        $resultados["Except"]['array'] = $array;

        /** @property Arr::exists */
        # O método Arr::exists verifica se a chave fornecida existe na matriz fornecida:
        $descricao["Exists"] = "O método Arr::exists verifica se a chave fornecida existe na matriz fornecida";
        $array = ['nome' => 'Urnau', 'canal' => 'Dev Tech Tips Brasil'];
        $resultados["Exists"]['nome'] = Arr::exists($array, 'nome') ? "sim": "não";
        $resultados["Exists"]['inscritos'] = Arr::exists($array, 'inscritos') ? "sim": "não";
        $resultados["Exists"]['array'] = $array;
        
        /** @property Arr::first */
        # O método Arr::first retorna o primeiro elemento de um array passando em um determinado teste de verdade:
        $descricao["First"] = "O método Arr::first retorna o primeiro elemento de um array passando em um determinado
        teste de verdade";
        $array = [100, 200, 300, 400, 500];
        $padrao = ["nenhum valor padrão definido."];
        $resultados["First"]['maior_que_150'] = Arr::first($array, fn ($value, $key) => $value >= 150, $padrao);
        $resultados["First"]['maior_que_800'] = Arr::first($array, fn ($value, $key) => $value >= 800, $padrao);
        $resultados["First"]['array'] = $array;

        /** @property Arr::flatten */
        # O método Arr::flatten nivela uma matriz multidimensional em uma matriz de nível único:
        $descricao["Flatten"] = "O método Arr::flatten nivela uma matriz multidimensional em uma matriz de nível único";
        $array = [
            'rede_sociais' => [
                'youtube' => [
                    'canal' => "Dev Tech Tips Brasil",
                    'inscritos' => 300,
                    'autor' => 'Urnau'
                ],
                'instagram' => "Indisponível"
            ]
        ];
        $resultados["Flatten"]['novo_array'] = Arr::flatten($array);
        $resultados["Flatten"]['array'] = $array;

        /** @property Arr::forget */
        # O método Arr::forget remove um determinado par chave/valor de uma matriz profundamente aninhada usando a
        # notação "ponto":
        $descricao["Forget"] = "O método Arr::forget remove um determinado par chave/valor de uma matriz profundamente
        aninhada usando a notação 'ponto'";
        $array = $array_bkp = [
            'rede_sociais' => [
                'youtube' => [
                    'canal' => "Dev Tech Tips Brasil",
                    'inscritos' => 300,
                    'autor' => 'Urnau'
                ],
                'instagram' => "Indisponível"
            ]
        ];
        ////// USA PONTEIRO
        Arr::forget($array, ['rede_sociais.youtube.inscritos', 'rede_sociais.instagram']);
        $resultados["Forget"]['remocao1'] = $array;
        Arr::forget($array, ['rede_sociais']);
        $resultados["Forget"]['remocao2'] = $array;
        $resultados["Forget"]['array'] = $array_bkp;


        /** @property Arr::get */
        # O método Arr::get recupera um valor de uma matriz profundamente aninhada usando a notação "ponto":
        $descricao["get"] = "O método Arr::get recupera um valor de uma matriz profundamente aninhada usando a notação
        'ponto'";
        $array = [
            'rede_sociais' => [
                'youtube' => [
                    'canal' => "Dev Tech Tips Brasil",
                    'inscritos' => 300,
                    'autor' => 'Urnau'
                ],
                'instagram' => "Indisponível"
            ]
        ];
        $padrao = "valor não encontrado!";
        $resultados["Get"]['Rede_sociais.Youtube.Autor'] = Arr::get($array, 'rede_sociais.youtube.autor', $padrao);

        /** @property Arr::has */
        # O método Arr::has verifica se um determinado item ou itens existe em uma matriz usando a notação "ponto":
        $descricao["Has"] = "O método Arr::has verifica se um determinado item ou itens existe em uma matriz usando a
        notação 'ponto'";
        $array = [
            'rede_sociais' => [
                    'youtube' => [
                    'canal' => "Dev Tech Tips Brasil",
                    'inscritos' => 300,
                    'autor' => 'Urnau'
                ],
                'instagram' => "Indisponível"
            ]
        ];
        $resultados["Has"]["product.name"] = Arr::has($array, 'product.name') ? "sim": "não";
        $resultados["Has"]["product.price_AND_rede_sociais.youtube.inscritos"] = Arr::has($array, ['product.price',
        'rede_sociais.youtube.inscritos']) ? "sim": "não";
        $resultados["Has"]["rede_sociais.instagram_AND_rede_sociais.youtube.inscritos"] = Arr::has($array,
        ['rede_sociais.instagram', 'rede_sociais.youtube.inscritos']) ? "sim": "não";


        /** @property Arr::hasAny */
        # O método Arr::hasAny verifica se algum item em um determinado conjunto existe em uma matriz usando a notação "ponto":
        $descricao["HasAny"] = "O método Arr::hasAny verifica se algum item em um determinado conjunto existe em uma
        matriz usando a notação 'ponto'";
        $array = [
            'rede_sociais' => [
                'youtube' => [
                    'canal' => "Dev Tech Tips Brasil",
                    'inscritos' => 300,
                    'autor' => 'Urnau'
                ],
                'instagram' => "Indisponível"
            ]
        ];
        $resultados["HasAny"]["product.name"] = Arr::hasAny($array, 'product.name') ? "sim": "não";
        $resultados["HasAny"]["product.price_OR_rede_sociais.youtube.inscritos"] = Arr::hasAny($array, ['product.price',
        'rede_sociais.youtube.inscritos']) ? "sim": "não";
        $resultados["HasAny"]["rede_sociais.instagram_OR_rede_sociais.youtube.inscritos"] = Arr::hasAny($array,
        ['rede_sociais.instagram', 'rede_sociais.youtube.inscritos']) ? "sim": "não";


        /** @property Arr::isAssoc */
        # O método Arr::isAssoc retorna true se a matriz fornecida for uma matriz associativa. 
        # Um array é considerado "associativo" se não tiver chaves numéricas sequenciais começando com zero:
        $descricao["IsAssoc"] = "O método Arr::isAssoc retorna true se a matriz fornecida for uma matriz associativa. 
        Um array é considerado 'associativo' se não tiver chaves numéricas sequenciais começando com zero";
        $resultados["IsAssoc"]["caso1"]= Arr::isAssoc(['product' => ['name' => 'Desk', 'price' => 100]]) ? "sim": "não"; // true
        $resultados["IsAssoc"]["caso2"]= Arr::isAssoc([1, 2, 3]) ? "sim": "não"; // false
        $resultados["IsAssoc"]["caso3"]= Arr::isAssoc([0=> 10, 1 => 20, 2 => 40]) ? "sim": "não"; // false
        $resultados["IsAssoc"]["caso4"]= Arr::isAssoc([0=> 10, 8 => 40]) ? "sim": "não"; // true
        $array = [1,2,3,4,5,6,6];
        unset($array[2]);
        $resultados["IsAssoc"]["caso5"]= Arr::isAssoc($array) ? "sim": "não"; // true


        /** @property Arr::isList */
        # O método Arr::isList retorna true se as chaves da matriz especificada forem números inteiros sequenciais
        # começando em zero:
        $descricao["IsList"] = "O método Arr::isList retorna true se as chaves da matriz especificada forem números
        inteiros sequenciais começando em zero";
        $resultados["IsList"]["caso1"]= Arr::isList(['product' => ['name' => 'Desk', 'price' => 100]]) ?
        "sim": "não"; // true
        $resultados["IsList"]["caso2"]= Arr::isList([1, 2, 3]) ? "sim": "não"; // false
        $resultados["IsList"]["caso3"]= Arr::isList([0=> 10, 1 => 20, 2 => 40]) ? "sim": "não"; // false
        $resultados["IsList"]["caso4"]= Arr::isList([0=> 10, 8 => 40]) ? "sim": "não"; // true
        $array = [1,2,3,4,5,6,6];
        unset($array[2]);
        $resultados["IsList"]["caso5"]= Arr::isList($array) ? "sim": "não"; // true


        /** @property Arr::join */
        # O método Arr::join une elementos do array com uma string. Usando o segundo argumento deste método, você também
        # pode especificar a string de junção para o elemento final do array:
        $descricao["Join"] = "O método Arr::join une elementos do array com uma string. Usando o segundo argumento deste
        método, você também pode especificar a string de junção para o elemento final do array";
        $array = ['Tailwind', 'Alpine', 'Laravel', 'Livewire', 'Blade'];
        $resultados["Join"]["sem_and"] = Arr::join($array, ', ');// Tailwind, Alpine, Laravel, Livewire
        $resultados["Join"]["com_and"] = Arr::join($array, ', ', ' and ');// Tailwind, Alpine, Laravel and Livewire


        /** @property Arr::keyBy */
        # O método Arr::keyBy chaveia o array pela chave dada. Se vários itens tiverem a mesma chave, apenas o último
        # aparecerá na nova matriz:
        $descricao["KeyBy"] = "O método Arr::keyBy chaveia o array pela chave dada. Se vários itens tiverem a mesma
        chave, apenas o último aparecerá na nova matriz";
        $array = [
            ['canal' => 'Dev Tech Tips Brasil', 'inscritos' => 300],
            ['canal' => 'Dev Tech Tips Brasil', 'inscritos' => 301],
            ['canal' => 'Dev Tech Tips Brasil', 'inscritos' => 302],
        ];
        $resultados["KeyBy"]["canal"] = Arr::keyBy($array, 'canal');


        /** @property Arr::last */
        # O método Arr::last retorna o último elemento de um array passando em um determinado teste de verdade:
        $descricao["Last"] = "O método Arr::last retorna o último elemento de um array passando em um determinado teste
        de verdade";
        $array = [100, 200, 300, 110];
        $padrao = "Valor padrão indefinido.";
        $resultados["Last"]["maior_que_150"] = Arr::last($array, function ($value, $key) {
            return $value >= 150;
        }, $padrao);


        /** @property Arr::map */
        # O método Arr::map itera pela matriz e passa cada valor e chave para o retorno de chamada fornecido. 
        # O valor da  matriz é substituído pelo valor retornado pelo retorno de chamada:
        $descricao["Map"] = "O método Arr::map itera pela matriz e passa cada valor e chave para o retorno de chamada
        fornecido. O valor da matriz é substituído pelo valor retornado pelo retorno de chamada";
        $array = ['first' => 'james', 'last' => 'kirk'];
        $resultados["Map"]["novo_array"] = Arr::map($array, function ($value, $key) {
            return ucfirst($value); //upercase first
        });
        $resultados["Map"]["array"] = $array;


        /** @property Arr::only */
        # O método Arr::only retorna apenas os pares de chave/valor especificados do array fornecido:
        $descricao["Only"] = "O método Arr::only retorna apenas os pares de chave/valor especificados do array
        fornecido";
        $array = [ 
            'canal' => "Dev Tech Tips Brasil",
            'inscritos' => 300,
            'autor' => 'Urnau'
        ];
        $resultados["Only"]["novo_array"] = Arr::only($array, ['canal', 'autor']);


        /** @property Arr::pluck */
        # O método Arr::pluck recupera todos os valores de uma determinada chave de uma matriz:
        $descricao["Pluck"] = "O método Arr::pluck recupera todos os valores de uma determinada chave de uma matriz";
        $array = [
            ['developer' => ['id' => 10, 'name' => 'Taylor']],
            ['developer' => ['id' => 20, 'name' => 'Abigail']],
            ['developer' => ['id' => 30, 'name' => 'Urnau']],
        ];
        $resultados["Pluck"]["apenas_name"] = Arr::pluck($array, 'developer.name');
        $resultados["Pluck"]["com_key_definida"] = Arr::pluck($array, 'developer.name', 'developer.id');


        /** @property Arr::prepend */
        # O método Arr::prepend irá empurrar um item para o início de um array:
        $descricao["Prepend"] = "O método Arr::prepend irá empurrar um item para o início de um array";
        $array = ['one', 'two', 'three', 'four'];
        $resultados["Prepend"]["apenas_valor"] =  Arr::prepend($array, 'zero');
        $array = ['inscritos' => 300];
        $resultados["Prepend"]["chave_valor"] = Arr::prepend($array, 'Urnau', 'autor');


        /** @property Arr::prependKeysWith */
        # O Arr::prependKeysWith prefixa todos os nomes de chave de uma matriz associativa com o prefixo fornecido:
        $descricao["PrependKeysWith"] = "O Arr::prependKeysWith prefixa todos os nomes de chave de uma matriz
        associativa com o prefixo fornecido";
        $array = [
            'autor' => 'Urnau',
            'inscritos' => 300,
        ];
        $resultados["PrependKeysWith"]["chave_valor"] = Arr::prependKeysWith($array, 'youtube.');


        /** @property Arr::pull */
        # O método Arr::pull retorna e remove um par chave/valor de um array:
        $descricao["Pull"] = "O método Arr::pull retorna e remove um par chave/valor de um array";
        $array = [
            'autor' => 'Urnau',
            'inscritos' => 300,
        ];
        /////// USA PONTEIRO
        $resultados["Pull"]["inscritos"] = Arr::pull($array, 'inscritos');
        $resultados["Pull"]["array"] = $array;


        /** @property Arr::query */
        # O método Arr::query converte a matriz em uma string de consulta:
        $descricao["Query"] = "O método Arr::query converte a matriz em uma string de consulta";
        $array = [
        'rede_sociais' => [
                'youtube' => [
                    'canal' => "Dev Tech Tips Brasil",
                    'inscritos' => 300,
                    'autor' => 'Urnau'
                ],
                'instagram' => "Indisponível"
            ]
        ];
        // $resultados["Query"]["resultado_1"] = Arr::query($array);
        $array = [
            'autor' => 'Urnau',
            'inscritos' => 300,
        ];
        $resultados["Query"]["resultado_2"] = Arr::query($array);


        /** @property Arr::random */
        # O método Arr::random retorna um valor aleatório de um array:
        $descricao["Random"] = "O método Arr::random retorna um valor aleatório de um array";
        $array = [1, 2, 3, 4, 5];
        $resultados["Random"]["resultado_1"] = Arr::random($array);
        $resultados["Random"]["resultado_2"] = Arr::random($array,3);
        $resultados["Random"]["resultado_3"] = Arr::random($array,2,true);


        /** @property Arr::set */
        # O método Arr::set define um valor dentro de uma matriz profundamente aninhada usando a notação "ponto":
        $descricao["Set"] = "O método Arr::set define um valor dentro de uma matriz profundamente aninhada usando a
        notação 'ponto'";
        $array = ['youtube' => ['canal' => ['inscritos' => 100]]];
        /////// USA PONTEIRO
        $resultados["Set"]["array"] = $array;
        $resultados["Set"]["chave_existente"] = Arr::set($array, 'youtube.canal.inscritos', 200);
        $resultados["Set"]["nova_chave"] = Arr::set($array, 'youtube.canal.autor', "Urnau");


        /** @property Arr::shuffle */
        # O método Arr::shuffle embaralha aleatoriamente os itens no array:
        $descricao["Shuffle"] = "O método Arr::shuffle embaralha aleatoriamente os itens no array";
        $array = [
            'canal' => "Dev Tech Tips Brasil",
            'inscritos' => 300,
            'autor' => 'Urnau'
        ];
        $resultados["Shuffle"]["array"] = $array;
        $resultados["Shuffle"]["resultado_1"] = Arr::shuffle($array);
        $resultados["Shuffle"]["resultado_2"] = Arr::shuffle([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);


        /** @property Arr::sort */
        # O método Arr::sort classifica um array por seus valores:
        $descricao["Sort"] = "O método Arr::sort classifica um array por seus valores";
        $array = ['Desk', 'Table', 'Chair', "House", "Channel", "Car"];
        $resultados["Sort"]["simples"] = Arr::sort($array);
        $array = [
            ['name' => 'Desk'],
            ['name' => 'Table'],
            ['name' => 'Chair'],
        ];
        $resultados["Sort"]["subnivel"] = array_values(Arr::sort($array, function ($value) {
            return $value['name'];
        }));


        /** @property Arr::sortRecursive */
        # O método Arr::sortRecursive classifica recursivamente um array usando a sort função para subarrays indexados
        # numericamente e a ksort função para subarrays associativos:
        $descricao["SortRecursive"] = "O método Arr::sortRecursive classifica recursivamente um array usando a sort
        função para subarrays indexados numericamente e a ksort função para subarrays associativos";
        $array = [
            ['Roman', 'Taylor', 'Li', "Urnau"],
            ['PHP', 'Ruby', 'JavaScript', "Go lang"],
            ['one' => 1, 'two' => 2, 'three' => 3, 'four' => 4, 'five' => 5, 'six' => 6, 'seven' => 7, 'eight' => 8, 'nine' => 9, 'ten' => 10]
        ];
        $resultados["SortRecursive"]["resultado"] = Arr::sortRecursive($array);


        /** @property Arr::toCssClasses */
        # O Arr::toCssClasses compila condicionalmente uma string de classe CSS. O método aceita um array de classes onde a
        # chave do array contém a classe ou classes que você deseja adicionar, enquanto o valor é uma expressão booleana.
        # Se o elemento array tiver uma chave numérica, ele sempre será incluído na lista de classes renderizadas:
        $descricao["ToCssClasses"] = "O Arr::toCssClasses compila condicionalmente uma string de classe CSS. O método
        aceita um array de classes onde a chave do array contém a classe ou classes que você deseja adicionar, enquanto o valor é uma expressão
        booleana. Se o elemento array tiver uma chave numérica, ele sempre será incluído na lista de classes renderizadas";
        $isActive = false;
        $hasError = true;
        $array = ['p-4', 'font-bold' => $isActive, 'bg-red' => $hasError];
        $resultados["ToCssClasses"]["array"] = $array;
        $resultados["ToCssClasses"]["resultado"] = Arr::toCssClasses($array);


        /** @property Arr::undot */
        # O método Arr::undot expande uma matriz unidimensional que usa a notação "ponto" em uma matriz multidimensional:
        $descricao["Undot"] = "O método Arr::undot expande uma matriz unidimensional que usa a notação 'ponto' em
        uma matriz multidimensional";
        $array = [
            'youtube.autor' => 'Urnau',
            'youtube.inscritos' => 300,
            'youtube.like' => true,
        ];
        $resultados["Undot"]["array"] = $array;
        $resultados["Undot"]["resultado"] = Arr::undot($array);


        /** @property Arr::where */
        # O método Arr::where filtra uma matriz usando o fechamento fornecido:
        $descricao["Where"] = "O método Arr::where filtra uma matriz usando o fechamento fornecido";
        $array = [100, '200', 300, '400', 500, "urnau"];
        $resultados["Where"]["resultado"] = Arr::where($array, function ($value, $key) {
            return is_string($value);
        });
        

        /** @property Arr::whereNotNull */
        # O método Arr::whereNotNull remove todos os null valores do array fornecido:
        $descricao["WhereNotNull"] = "O método Arr::whereNotNull remove todos os null valores do array fornecido";
        $array = [0, null, ""];
        $resultados["WhereNotNull"]["resultado"] = Arr::whereNotNull($array);
        

        /** @property Arr::wrap */
        # O método Arr::wrap envolve o valor fornecido em uma matriz. 
        # Se o valor fornecido já for um array, ele será retornado sem modificação:
        $descricao["Wrap"] = "O método Arr::wrap envolve o valor fornecido em uma matriz. Se o valor fornecido já for um array, ele será retornado sem modificação";
        $string = 'Laravel';
        $resultados["Wrap"]["array_simples"] = Arr::wrap($string);
        $string = ["autor" => 'Urnau'];
        $resultados["Wrap"]["array_associativo"] = Arr::wrap($string);
        $string = null;
        $resultados["Wrap"]["valor_nulo"] = Arr::wrap($string);


        // data_fill
        // data_get
        // data_set
        // head
        // last


        return view('pages.helpers', compact('resultados', 'descricao'));
    }
}
