<?php

print_r(getSmoothie('Clássico', '+bananada, -morango, -abacaxi, -mel'));


function getSmoothie($nomeSmoothie, $sabores) {

    $arrSmoothies = get_object_vars(json_decode('{"Clássico": ["morango", "banana", "abacaxi", "manga", "pêssego", "mel", "gelo", "iogurte"],
        "Forest Berry": ["morango", "framboesa", "mirtilo", "mel", "gelo", "iogurte"],
        "Freezie": ["amora", "mirtilo", "groselha preta", "suco de uva", "iogurte congelado"],
        "Greenie": ["maçã verde", "kiwi", "limão", "abacate", "espinafre", "gelo", "suco de maçã"],
        "Vegan Delite": ["morango", "maracujá", "abacaxi", "manga", "pêssego", "gelo", "leite de soja"],
        "Apenas sobremesas": ["banana", "sorvete", "chocolate", "amendoim", "cereja"]}'));

    foreach($arrSmoothies as $nome => $smoothies) {

        // Se o nome do smoothies passado é o mesmo do Json informado
        if ($nome == $nomeSmoothie) {

            // transformar em array o array de sabores
            $arrAcaoSabores = explode(',', $sabores);

            // loop para verificar as ações e sabores
            foreach($arrAcaoSabores as $keyAcaoSabor => $acaoSabor) {
            
                $acao = substr(trim($acaoSabor), 0, 1);
                $sabor = substr(trim($acaoSabor), 1);
                
                // verifica qual será a ação a tomar
                if ($acao == '+') {

                    if (in_array($sabor, $arrSmoothies[$nome])) {
                        print_r($sabor . ' já existe na receita do Smoothie ' . $nomeSmoothie . '.');die();
                    }
                    array_push($arrSmoothies[$nome], $sabor);

                } else if ($acao == '-') {

                    foreach($smoothies as $key => $smoothie) {

                        if ($smoothie == $sabor) {
                            unset($arrSmoothies[$nome][$key]);
                        }

                    }

                } else {
                    print_r('sem ação');die();
                }
            }
            return $arrSmoothies;
            
        } else {
            return 'Smoothie não existente!';
        }
    }
}

