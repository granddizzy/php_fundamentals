<?php
//В функцию передается строка скобок. Например:
//()()(())
//Надо на выходе показать, корректна ли последовательность.
//Некорректные последовательности
//")("  "())("

function isValidBrackets(string $brackets): bool
{
  $stack = [];

  for ($i = 0; $i < strlen($brackets); $i++) {
    $char = $brackets[$i];

    if ($char === '(') {
      array_push($stack, $char); // Добавляем открывающую скобку в стек
    } elseif ($char === ')') {
      if (empty($stack)) {
        return false; // Если стек пуст, а текущий символ - закрывающая скобка
      }
      array_pop($stack); // Убираем из стека последнюю открывающую скобку
    }
  }

  return empty($stack); // Если стек пуст, то последовательность корректна
}

$testCases = ['()()(())', ')(', '())('];

foreach ($testCases as $testCase) {
  echo "$testCase: " . (isValidBrackets($testCase) ? 'Корректная' : 'Некорректная') . "\n";
}