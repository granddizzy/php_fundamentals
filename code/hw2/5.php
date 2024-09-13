<?php
//С помощью рекурсии организовать функцию возведения числа в степень.
//Формат:
//function power(f^oat $valz float $pow) : float {}
//где $val - заданное число, $pow - степень.
function power(float $val, float $pow): float|string
{
  if ($pow == 0) {
    return 1.0;
  } elseif ($pow < 0) {
    if ($val == 0) return "Деление на ноль невозможно.";
    return 1 / power($val, -$pow);;
  }

  if ($pow == 1) {
    return $val;
  }

  return $val * power($val, $pow - 1);
}

echo power(2, 3);   // Выведет 8
echo "\n";
echo power(5, 0);   // Выведет 1
echo "\n";
echo power(3, 4);   // Выведет 81
echo "\n";
echo power(0, -1);   // Деление на ноль невозможно
echo "\n";
echo power(2, -3);   // Выведет 0.125