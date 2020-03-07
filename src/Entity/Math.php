<?php

namespace nsivtsev\SimpleMathBundle\Entity;

use function Couchbase\defaultDecoder;

class Math implements MathInterface
{
    /**
     * Math constructor.
     */
    public function __construct()
    {
    }

    public function solveFromString(string $problem)
    {
        return $this->rpn($problem);
    }

    /**
     * Реализация алгоритма приведения строки к обратной Польской записи
     * Взято из https://ru.wikiversity.org/wiki/Обратная_польская_запись:_примеры_реализации#PHP
     * @param $str
     * @return string
     */
    private function rpn($str)
    {
        $stack=array(); //объявляем массив стека
        $out=array(); //объявляем массив выходной строки

        $prior = array ( //задаем приоритет операторов, а также их ассоциативность
            "^"=> array("prior" => "4", "assoc" => "right"),
            "*"=> array("prior" => "3", "assoc" => "left"),
            "/"=> array("prior" => "3", "assoc" => "left"),
            "+"=> array("prior" => "2", "assoc" => "left"),
            "-"=> array("prior" => "2", "assoc" => "left"),
        );

        $token=preg_replace("/\s/", "", $str); //удалим все пробелы
        $token=str_replace(",", ".", $token);//поменяем запятые на точки
        $token = str_split($token);
        /*проверим, не является ли первый символ знаком операции - тогда допишем 0 перед ним */

        if (preg_match("/[\+\-\*\/\^]/",$token['0'])){array_unshift($token, "0");}

        $lastnum = TRUE; //в выражении теперь точно первым будет идти число - поставим маркер

        foreach ($token as $key=>$value)
        {
            dump($value);
            if (preg_match("/[\+\-\*\/\^]/",$value))//если встретили оператор
            {
                $endop = FALSE; //маркер конца цикла разбора операторов

                while ($endop != TRUE)
                {
                    $lastop = array_pop($stack);
                    dump($lastop);
                    if ($lastop=="")
                    {
                        $stack[]=$value; //если в стеке нет операторов - просто записываем текущий оператор в стек
                        $endop = TRUE; //укажем, что цикл разбора while закончился
                    }

                    else //если в стеке есть операторы - то последний сейчас в переменной $lastop
                    {
                        /* получим приоритет и ассоциативность текущего оператора и сравним его с $lastop */
                        $curr_prior = $prior[$value]['prior']; //приоритет текущиего оператора
                        $curr_assoc = $prior[$value]['assoc']; //ассоциативность текущиего оператора

                        $prev_prior = $prior[$lastop]['prior']; //приоритет предыдущего оператора

                        switch ($curr_assoc) //проверяем текущую ассоциативность
                        {
                            case "left": //оператор - лево-ассоциативный

                                switch ($curr_prior) //проверяем текущий приоритет лево-ассоциаивного оператора
                                {
                                    case ($curr_prior > $prev_prior): //если приоритет текущего опертора больше предыдущего, то записываем в стек предыдущий, потом текйщий
                                        $stack[]=$lastop;
                                        $stack[]=$value;
                                        $endop = TRUE; //укажем, что цикл разбора операторов while закончился
                                        break;

                                    case ($curr_prior <= $prev_prior): //если тек. приоритет меньше или равен пред. - выталкиваем пред. в строку out[]
                                        $out[] = $lastop;
                                        break;
                                }

                                break;

                            case "right": //оператор - право-ассоциативный

                                switch ($curr_prior) //проверяем текущий приоритет право-ассоциативного оператора
                                {
                                    case ($curr_prior >= $prev_prior): //если приоритет текущего опертора больше или равен предыдущего, то записываем в стек предыдущий, потом текйщий
                                        $stack[]=$lastop;
                                        $stack[]=$value;
                                        $endop = TRUE; //укажем, что цикл разбора операторов while закончился
                                        break;

                                    case ($curr_prior < $prev_prior): //если тек. приоритет меньше пред. - выталкиваем пред. в строку out[]
                                        $out[] = $lastop;
                                        break;
                                }

                                break;

                        }

                    }
                } //while ($endop != TRUE)
                $lastnum = false; //укажем, что последний разобранный символ - не цифра
            }

            elseif (preg_match("/[0-9\.]/",$value)) //встретили цифру или точку
            {
                /*Мы встретили цифру или точку (дробное число). Надо понять, какой символ был разобран перед ней.
                За это отвечает переменная $lastnum - если она TRUE, то последней была цифра.
                В этом случае надо дописать текущую цифру к последнему элменту массива выходной строки*/
                if ($lastnum == TRUE) //последний разобранный символ - цифра
                {
                    $num = array_pop($out); //извлечем содержимое последнего элемента массива строки
                    $out[]=$num.$value;
                }

                else
                {
                    $out[] = $value; //если последним был знак операции - то открываем новый элемент массива строки
                    $lastnum = TRUE; //и указываем, что последним была цифра
                }
            }

            elseif ($value=="(") //встреили скобку ОТкрывающую
            {
                /*Мы встретили ОТкрывающую скобку - надо просто поместить ее в стек*/
                $stack[] = $value;
                $lastnum = FALSE; // указываем, что последним была НЕ цифра
            }

            elseif ($value==")") //встреили скобку ЗАкрывающую
            {
                /*Мы встретили ЗАкрывающую скобку - теперь выталкиваем с вершины стека в строку все операторы, пока не встретим ОТкрывающую скобку*/
                $skobka = FALSE; //маркер нахождения открывающей скобки
                while ($skobka != TRUE) //пока не найдем в стеке ОТкрывающую скобку
                {
                    $op = array_pop($stack); //берем оператора с вершины стека

                    if ($op == "(")
                    {
                        $skobka = TRUE; //если встретили открывающую - меняем маркер
                    }

                    else
                    {
                        $out[] = $op; //если это не скобка - отправляем символ в строку
                    }


                }

                $lastnum = FALSE; //указываем, что последним была НЕ цифра
            }

        }
        /*foreach закончился - мы разобрали все выражение
        теперь вытолкнем все оставшиеся элементы стека в выходную строку, начиная с вершины стека*/

        $stack1 = $stack; //временный массив, копия стека, на случай, если будет нужен сам стек для дебага
        $rpn = $out; //начинаем формировать итоговую строку

        while ($stack_el = array_pop($stack1))
        {
            $rpn[]=$stack_el;
        }
        return $this->calc(implode(" ", $rpn));
    }

    private function calc($str)
    {
        $stack = array();

        $token = strtok($str, ' ');

        while ($token !== false)
        {
            if (in_array($token, array('*', '/', '+', '-', '^')))
            {
                if (count($stack) < 2)
                    throw new Exception("Недостаточно данных в стеке для операции '$token'");
                $b = array_pop($stack);
                $a = array_pop($stack);
                switch ($token)
                {
                    case '*': $res = $a*$b; break;
                    case '/': $res = $a/$b; break;
                    case '+': $res = $a+$b; break;
                    case '-': $res = $a-$b; break;
                    case '^': $res = pow($a,$b); break;

                }
                array_push($stack, $res);
            } elseif (is_numeric($token))
            {
                array_push($stack, $token);
            } else
            {
                throw new Exception("Недопустимый символ в выражении: $token");
            }

            $token = strtok(' ');
        }
        if (count($stack) > 1)
            throw new Exception("Количество операторов не соответствует количеству операндов");
        return array_pop($stack);
    }
}