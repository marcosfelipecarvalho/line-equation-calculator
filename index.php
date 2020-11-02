<?php
    if(isset($_POST['calcular'])){
        
        function reduzida(){

            // Fórmula y-y0=m(x-xo)

            $xa = $_POST['xa'];
            $xb = $_POST['xb'];
            $ya = $_POST['ya'];
            $yb = $_POST['yb'];
        
            $operando_y = $ya - $yb;
            $operando_x = $xa - $xb;
            $coeficiente_angular = $operando_y / $operando_x;
            $operando_ya = $ya * -1;
            $operando_coeficiente_angular = $coeficiente_angular * ($xa * -1);
            $trocando_sinal_ya = $operando_ya * -1;
            $coeficiente_linear = $operando_coeficiente_angular + $trocando_sinal_ya;
        
            $resultado_reduzida = null;
        
            if($operando_x == 0){
                $resultado_reduzida = "Syntax error!";
            }else if($coeficiente_angular == 0){
                $resultado_reduzida = "Syntax error!";
            }else if($coeficiente_linear > 0){
                $resultado_reduzida = "y" . " " . "=" . " " . $coeficiente_angular . "x" . " " . "+" . " " . $coeficiente_linear;
            }else if($coeficiente_linear < 0){
                $resultado_reduzida = "y" . " " . "=" . " " .  $coeficiente_angular . "x" . " " . "-" . " " . $coeficiente_linear * -1;
            }else{
                $resultado_reduzida = "y" . " " . "=" . " " .  $coeficiente_angular . "x";
            }
        
            return $resultado_reduzida;
        }

        function geral(){

            // Fórmula: ax + by + c = 0

            $xa = $_POST['xa'];
            $xb = $_POST['xb'];
            $ya = $_POST['ya'];
            $yb = $_POST['yb'];

            // Operando as diagonais secundárias

            $primeira_diagonal_secundaria = $xb * $ya * -1;
            $segunda_diagonal_secundaria = $yb * -1; //Concatenar com X
            $terceira_diagonal_secundaria = $xa * -1; //Concatenar com Y
            
            // Operando as diagonais principais

            $primeira_diagonal_principal = $ya; //Concatenar com X
            $segunda_diagonal_principal = $xb; //Concatenar com Y
            $terceira_diagonal_principal = $xa * $yb;

            // Somando as diagonais de acordo com suas variáveis

            $coeficiente_x = $segunda_diagonal_secundaria + $primeira_diagonal_principal;
            $coeficiente_y = $terceira_diagonal_secundaria + $segunda_diagonal_principal;
            $coeficiente_c = $primeira_diagonal_secundaria + $terceira_diagonal_principal;
            
            $resultado_geral = $coeficiente_x ."x" . " " . "+" . " " . $coeficiente_y . "y" . " " . "+" ."" . $coeficiente_c;

            return $resultado_geral;
        }

        $resultado_equacao_reduzida = reduzida();
        $resultado_equacao_geral = geral();
    }   
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Equação da reta</title>
        <link rel="stylesheet" type="text/css" href="./css/styles.css"/>
    </head>
    <body>
        <section>
            <header>
                Calculadora de equação da reta
            </header>
            <main>
                <h3>Informe os quatro pontos da reta<h3>
                <form method="post" name="form-calculo" action="index.php">
                    <div class="linhas">
                        <div class="colunas">
                            <label>Informe o valor de xa:</label>
                            <input type="number" name="xa"/>
                        </div>
                        <div class="colunas">
                            <label>Informe o valor de ya:</label>
                            <input type="number" name="ya"/>
                        </div>
                    </div>
                    <div class="linhas">
                        <div class="colunas">
                            <label>Informe o valor de xb:</label>
                            <input type="number" name="xb"/>
                        </div>
                        <div class="colunas">
                            <label>Informe o valor de yb:</label>
                            <input type="number" name="yb"/>
                        </div>
                    </div>
                    <input type="submit" value="Calcular" class="botao" name="calcular">
                </form>
            </main>
            <footer>
                <div class="resultados">
                    <span>Equação reduzida</span>
                    <p><?=$resultado_equacao_reduzida?></p>
                </div>  
                <div class="resultados">
                    <span>Equação geral</span>
                    <p><?=$resultado_equacao_geral?></p>
                </div>
            </footer>
        </section>
    </body>
</html>