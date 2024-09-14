<?php

function validateDate(string $data): bool
{
  $dateBlock = explode('-', $data);

  if (count($dateBlock) < 3) {
    return false;
  }

  $day = (int)$dateBlock[0];
  $month = (int)$dateBlock[1];
  $year = (int)$dateBlock[2];

  if ($year > date('Y')) {
    return false;
  }

  if ($month < 1 || $month > 12) {
    return false;
  }

  $daysInMonth = [
    1 => 31, // Январь
    2 => 28, // Февраль
    3 => 31, // Март
    4 => 30, // Апрель
    5 => 31, // Май
    6 => 30, // Июнь
    7 => 31, // Июль
    8 => 31, // Август
    9 => 30, // Сентябрь
    10 => 31, // Октябрь
    11 => 30, // Ноябрь
    12 => 31  // Декабрь
  ];

  // проверяем на високосный
  if ($month == 2 && (($year % 4 == 0 && $year % 100 != 0) || ($year % 400 == 0))) {
    $daysInMonth[2] = 29;
  }

  if ($day < 1 || $day > $daysInMonth[$month]) {
    return false;
  }

  return true;
}

function validateName(string $name): bool
{
  $minLength = 1;
  $maxLength = 255;

  if (strlen($name) === 0) {
    return false;
  }

  if (strlen($name) < $minLength || strlen($name) > $maxLength) {
    return false;
  }

  return true;
}

function removeUnwantedChars(string $input): string
{
  $unwantedChars = [',', ';', '!', '@'];
  $cleaned = str_replace($unwantedChars, '', $input);

  // Заменяем один или несколько пробелов на один пробел
  return preg_replace('/\s+/', ' ', $cleaned);
}