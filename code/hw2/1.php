<?php
//1. Реализовать основные 4 арифметические операции в виде функции с тремя параметрами - два параметра это числа,
// третий - операция. Обязательно использовать оператор return.
//Например,
//function add(int Sargb int $arg2) : int { // тело функции
//2. Реализовать функцию с тремя параметрами: function mathOperation($argl, $arg2, $operation). где $argl, $arg2 -
// значения аргументов. $operation - строка с названием операции. В зависимости от переданного значения операции
// выполнить одну из арифметических операций (использовать функции из пункта 3) и вернуть полученное значение
// (использовать switch).
//Например.
//function maLhOperation(string $action) : float {

function add(int $arg1, int $arg2): int
{
  return $arg1 + $arg2;
}

function subtract(int $arg1, int $arg2): int
{
  return $arg1 - $arg2;
}

function multiply(int $arg1, int $arg2): int
{
  return $arg1 * $arg2;
}

function divide(int $arg1, int $arg2): float|string
{
  if ($arg2 === 0) {
    return "Ошибка: деление на ноль!";
  }
  return $arg1 / $arg2;
}

function mathOperation(int $arg1, int $arg2, string $operation): float|int|string
{
//  switch ($operation) {
//    case 'add':
//      return add($arg1, $arg2);
//    case 'subtract':
//      return subtract($arg1, $arg2);
//    case 'multiply':
//      return multiply($arg1, $arg2);
//    case 'divide':
//      return divide($arg1, $arg2);
//    default:
//      return "Ошибка: недопустимая операция!";
//  }

  if (function_exists($operation)) {
    return $operation($arg1, $arg2);
  }

  return "Ошибка: недопустимая операция!";
}

echo mathOperation(10, 5, 'add');       // Выведет 15
echo "\n";
echo mathOperation(10, 5, 'subtract');  // Выведет 5
echo "\n";
echo mathOperation(10, 5, 'multiply');  // Выведет 50
echo "\n";
echo mathOperation(10, 5, 'divide');    // Выведет 2
echo "\n";
echo mathOperation(10, 0, 'divide');    // Выведет "Ошибка: деление на ноль!"
echo "\n";
echo mathOperation(10, 5, 'modulus');   // Выведет "Ошибка: недопустимая операция!"