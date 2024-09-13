<?php
//Написать функцию, которая вычисляет текущее время и возвращает его в формате с правильными склонениями, например:
//22 часа 15 минут
//21 час 43 минуты

function declension($number, $words)
{
  if ($number % 10 == 1 && $number % 100 != 11) {
    return $words[0];
  } elseif (($number % 10 >= 2 && $number % 10 <= 4) && ($number % 100 < 10 || $number % 100 >= 20)) {
    return $words[1];
  } else {
    return $words[2];
  }
}

function getCurrentTimeFormatted(): string
{
  date_default_timezone_set('Europe/Moscow');

  $currentTime = new DateTime();

  $hours = $currentTime->format('G');
  $minutes = $currentTime->format('i');

  $hourWord = declension($hours, ['час', 'часа', 'часов']);
  $minuteWord = declension($minutes, ['минута', 'минуты', 'минут']);

  return "{$hours} {$hourWord} {$minutes} {$minuteWord}";
}

echo getCurrentTimeFormatted();