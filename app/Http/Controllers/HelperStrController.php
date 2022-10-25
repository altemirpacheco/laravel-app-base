<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HelperStrController extends Controller
{
    private function generateResultados(): array {
        $resultados = [];
        $descricao = [];
        
        /** CORTAR STRING */
        $resultados['After']['resultado'] = str()->after(
            'É hora de se inscrever no canal!', 'hora');
        $descricao['After'] = [ 
            'Str::after($texto, $trecho)',
            "Retorna o que vem depois do trecho informado.",
            "",
            "Texto: É hora de se inscrever no canal!",
            "Trecho: hora"
        ];

        $resultados['AfterLast']['resultado'] = Str::afterLast("App\Http\Controllers\HelperStrController", "\\");
        $descricao['AfterLast'] = [
            'Str::afterLast($texto, $techo)',
            "Pega o texto após a última ocorrência do trecho informado.",
            "",
            "Texto: App\Http\Controllers\HelperStrController",
            "Trecho: \\"
        ];

        # Saiba mais sobre o ascii https://www.ime.usp.br/~pf/algoritmos/apend/ascii.html
        $resultados['Ascii']['resultado'] = Str::ascii(
            'Campeão àèìòùUÚçãõñ...');
        $descricao['Ascii'] = [
            'Str::ascii($texto)',
            "Tranforma todo texto em ASCII",
            "",
            "Texto: Campeão àèìòùUÚçãõñ...",
        ];

        $resultados['Before']['resultado'] = Str::before(
            'É hora de se inscrever no canal!', 'inscrever');
        $descricao['Before'] = [
            'Str::before($texto, $trecho)',
            "Retorna o que há antes do trecho informado",
            "",
            "Texto: É hora de se inscrever no canal!",
            "Techo: inscrever"
        ];

        $resultados['BeforeLast']['resultado'] = Str::beforeLast(
            'É hora de se inscrever no canal, ajude o canal a crescer!', 'canal');
        $descricao['BeforeLast'] = [
            'Str::beforeLast($texto, $trecho)',
            "Retorna o texto que há antes da última ocorrência",
            "",
            "Texto: É hora de se inscrever no canal, ajude o canal a crescer!",
            "Trecho: canal"
        ];

        $resultados['Between']['resultado'] = Str::between('É hora de se inscrever no canal e dar like no vídeo, isso ajuda a crescer ainda mais o canal e há dominarmos o mundo!', 'de', 'canal');
        $descricao['Between'] = [
            'Str::between($texto, $trechoInicial, $techoFinal)',
            "Retorna todo texto que existe entre dois trechos",
            "",
            "Texto: É hora de se inscrever no canal e dar like no vídeo, isso ajuda a crescer ainda mais o canal e há dominarmos o mundo!",
            "Trecho Inicial: de",
            "Trecho Final: canal"
        ];


        $resultados['BetweenFirst']['resultado'] = Str::betweenFirst('É hora de se inscrever no canal e dar like no vídeo, isso ajuda a crescer ainda mais o canal e há dominarmos o mundo!', 'de', 'canal');
        $descricao['BetweenFirst'] = [ 
            'Str::betweenFirst($texto, $trechoInicial, $trechoFinal)',
            "Retorna todo texto que existe entre as primeiras aparições dos trechos informados.",
            "",
            "Texto: É hora de se inscrever no canal e dar like no vídeo, isso ajuda a crescer ainda mais o canal e há dominarmos o mundo!",
            "Trecho Inicial: de",
            "Trecho Final: canal"
        ];

        // mb_strlen, strlen
        $resultados['Length']['resultado'] = Str::length(
            "Dev Tech Tips Brasil com Urnau"
        );
        $descricao['Length'] = [
            'Str::length($texto)',
            "Retorna o tamanho de uma string",
            "",
            "Texto: Dev Tech Tips Brasil com Urnau",
        ];


        $resultados['Limit']['resultado'] = Str::limit(
            'Dev Tech Tips Brasil com Urnau', 15, "");
        $descricao['Limit'] = [
            'Str::limit($texto, $numero_maximo_caracteres)',
            "Retorna um texto com o máximo de caracteres informado.",
            "",
            "Texto: Dev Tech Tips Brasil com Urnau",
            "Máximo de Caracteres: 15"
        ];

        # o default é com ... no final
        $resultados['Limit(alt)']['resultado'] = Str::limit('Dev Tech Tips Brasil com Urnau', 15, '...');
        $descricao['Limit(alt)'] = [
            'Str::limit($texto, $numero_maximo_caracteres, $trecho_final)',
            "Retorna um texto com o máximo de caracteres informado + o trecho final desejado, assim você pode utilizar ..., etc, entre outros...",
            "",
            "Texto: Dev Tech Tips Brasil com Urnau",
            "Máximo de Caracteres: 15"
        ];


        $resultados['Substr']['resultado'] = Str::substr(
            'Dev Tech Tips Brasil com Urnau', 14, 6);
        $descricao['Substr'] = [
            'Str::substr($texto, $posicaoInicial, $tamanho)',
            "Recorta um determinado trecho de um texto com base nas posições de caracteres e tamanho de resultado informado.",
            "",
            "Texto: Dev Tech Tips Brasil com Urnau",
            "Posição Inicial: 14",
            "Tamanho: 6"
        ];

        $hora_e_minuto_atual = now()->format('Hi');//ex: 2150
        $resultados['SubstrReplace']['resultado'] = Str::substrReplace(
            $hora_e_minuto_atual, ':', 2);
        $descricao['SubstrReplace'] = [
            'Str::substrReplace(texto, $trechoSubstituto, $posicaoDeCorte)',
            "Pega um texto, encontra a posição de corte informada e substituí tudo a partir dalí até o fim.",
            "Texto: {$hora_e_minuto_atual}",
            "Trecho Substituto: :",
            "Posição de Corte: 2"
        ];


        $hora_e_minuto_atual = now()->format('H-i');//ex: 2130
        $resultados['SubstrReplace(alt)']['resultado'] = Str::substrReplace(
            $hora_e_minuto_atual, ':', 2, 1
        );
        $descricao['SubstrReplace(alt)'] = [
            'Str::substrReplace($texto, $trechoSubstituto, $posicaoDeCorte, $tamanho)',
            "Pega um texto, encontra a posição de corte informada e insere alí o trecho desejado, para isso use tamanho = 0.",
            "Texto: {$hora_e_minuto_atual}",
            "Trecho Substituto: :",
            "Posição de Corte: 2",
            "Tamanho: 0"
        ];


        $resultados['Words']['resultado'] = Str::words(
            'Dev Tech Tips Brasil com Urnau, o canal feito de desenvolvedor para desenvolvedor!', 3, ' [saiba mais]');
        $descricao['Words'] = [
            'Str::words($texto, $quantidadePalavras, $trechoFinal)',
            "Após a quantidade de palavras informadas, é feito um corte no texto e inserido o trecho desejado.",
            "",
            "Texto: Dev Tech Tips Brasil com Urnau, o canal feito de desenvolvedor para desenvolvedor!",
            "Quantidade de Palavras: 3",
            "Trecho Final:  [saiba mais]"
        ];


        return [$resultados, $descricao];

        /** ADAPTAR/CONVERTER STRING */
        $converted = Str::camel('foo_bar');
        $excerpt = Str::excerpt('This is my name', 'my', ['radius' => 3]);
        $excerpt = Str::excerpt('This is my name', 'name', [
            'radius' => 3,
            'omission' => '(...) '
        ]);
        $adjusted = Str::finish('this/string', '/');
        $adjusted = Str::finish('this/string/', '/');
        $headline = Str::headline('steve_jobs');
        $headline = Str::headline('EmailNotificationSent');
        $html = Str::inlineMarkdown('**Laravel**');
        $converted = Str::kebab('fooBar');//kebab-case
        $string = Str::lcfirst('Foo Bar');// primeira letra minuscula
        $converted = Str::lower('LARAVEL');
        $html = Str::markdown('# Laravel');
        $html = Str::markdown('# Taylor <b>Otwell</b>', [
            'html_input' => 'strip',
        ]);
        $string = Str::mask('taylor@example.com', '*', 3);
        $string = Str::mask('taylor@example.com', '*', -15, 3);
        $padded = Str::padBoth('James', 10, '_');
        $padded = Str::padBoth('James', 10);
        $padded = Str::padLeft('James', 10, '-=');
        $padded = Str::padLeft('James', 10);
        $padded = Str::padRight('James', 10, '-');
        $padded = Str::padRight('James', 10);
        $reversed = Str::reverse('Hello World');
        $slug = Str::slug('Laravel 5 Framework', '-');
        $converted = Str::snake('fooBar');
        $converted = Str::snake('fooBar', '-');
        $string = Str::squish('    laravel    framework    ');// laravel framework
        $converted = Str::studly('foo_bar');// StudlyCase FooBar
        $string = Str::swap([
            'Tacos' => 'Burritos',
            'great' => 'fantastic',
        ], 'Tacos are great!');// Burritos are fantastic!
        $converted = Str::title('a nice title uses the correct case');//Title Case
        $string = Str::ucfirst('foo bar');// primeira letra maiuscula
        $segments = Str::ucsplit('FooBar');// [0 => 'Foo', 1 => 'Bar']
        $string = Str::upper('laravel');

        /** VALIDAR STRING */
        $contains = Str::contains('This is my name', 'my');
        $contains = Str::contains('This is my name', ['my', 'foo']);
        $containsAll = Str::containsAll('This is my name', ['my', 'name']);
        $result = Str::endsWith('This is my name', 'name');
        $result = Str::endsWith('This is my name', ['name', 'foo']);
        $matches = Str::is('foo*', 'foobar');
        $matches = Str::is('baz*', 'foobar');
        $isAscii = Str::isAscii('Taylor');
        $isAscii = Str::isAscii('ü');
        $result = Str::isJson('[1,2,3]');
        $result = Str::isJson('{"first": "John", "last": "Doe"}');
        $result = Str::isJson('{first: "John", last: "Doe"}');
        $isUuid = Str::isUuid('a0a2a2d2-0b87-4a18-83f2-2529882be2de');
        $isUuid = Str::isUuid('laravel');
        $adjusted = Str::start('this/string', '/');
        $adjusted = Str::start('/this/string', '/');
        $result = Str::startsWith('This is my name', 'This');
        $result = Str::startsWith('This is my name', ['This', 'That', 'There']);
        $count = Str::substrCount('If you like ice cream, you will like snow cones.', 'like');
        $count = Str::wordCount('Hello, world!'); // 2
        
        /** PLURAL 
         * AppServiceProvider setar Pluralizer::useLanguage('spanish'); na booted
        */
        $plural = Str::plural('car');
        $plural = Str::plural('child'); 
        $plural = Str::plural('child', 2);
        $singular = Str::plural('child', 1);
        $plural = Str::pluralStudly('VerifiedHuman');
        $plural = Str::pluralStudly('UserFeedback');
        $plural = Str::pluralStudly('VerifiedHuman', 2);
        $singular = Str::pluralStudly('VerifiedHuman', 1);
        $singular = Str::singular('cars');
        $singular = Str::singular('cars');


        /** SUBSTITUIR OU REMOVER STRING */
        $string = 'Peter Piper picked a peck of pickled peppers.';
        $removed = Str::remove('e', $string);
        $string = 'Laravel 8.x';
        $replaced = Str::replace('8.x', '9.x', $string);
        $string = 'The event will take place between ? and ?';
        $replaced = Str::replaceArray('?', ['8:30', '9:00'], $string);
        $replaced = Str::replaceFirst('the', 'a', 'the quick brown fox jumps over the lazy dog');
        $replaced = Str::replaceLast('the', 'a', 'the quick brown fox jumps over the lazy dog');


        /** OUTROS */
        $uuid = (string) Str::orderedUuid();
        $random = Str::random(40);
        $htmlString = Str::of('Nuno Maduro')->toHtmlString();
        $ulid = (string) Str::ulid();// 01gd6r360bp37zj17nxb55yv40
        $uuid = (string) Str::uuid();

        // return [$resultados, $descricao];
    }

    public function index() {
        [$resultados, $descricao] = $this->generateResultados();

        return view('pages.helpers.str', compact('resultados', 'descricao'));
    }

    public function indexDD() {
        [$resultados, $descricao] = $this->generateResultados();
        dd($resultados, $descricao);
    }
}
