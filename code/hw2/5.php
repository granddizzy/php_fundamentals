<?php
//С помощью рекурсии организовать функцию возведения числа в степень.
//Формат:
//function power(f^oat $valz float $pow) : float {}
//где $val - заданное число, $pow - степень.
function power(float $val, float $pow): float
{
  if ($pow == 0) {
    return 1.0;
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