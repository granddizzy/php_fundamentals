<?php
//Объявить массив, индексами которого являются буквы русского языка, а значениями - соответствующие латинские
//буквосочетания (‘а’=> ’а’, ‘б’ => ‘Ь’, ‘в’ => ‘v’, ‘г’ => ‘g’, ..., 'э' => ‘е’, ‘ю’ => ‘уи’, ‘я’ => 'уа’)-
// Написать функцию транслитерации строк.
//Пример функции
//function transliterate(string $russianString) : string { // тело функции
//return $englishString;
//}
//echo transliterate('Привет'); // выводит Privet

$transliterationMap = [
  'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd',
  'е' => 'e', 'ё' => 'yo', 'ж' => 'zh', 'з' => 'z', 'и' => 'i',
  'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n',
  'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
  'у' => 'u', 'ф' => 'f', 'х' => 'kh', 'ц' => 'ts', 'ч' => 'ch',
  'ш' => 'sh', 'щ' => 'shch', 'ы' => 'y', 'э' => 'e', 'ю' => 'yu',
  'я' => 'ya', ' ' => ' ',
  'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D',
  'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh', 'З' => 'Z', 'И' => 'I',
  'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N',
  'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T',
  'У' => 'U', 'Ф' => 'F', 'Х' => 'Kh', 'Ц' => 'Ts', 'Ч' => 'Ch',
  'Ш' => 'Sh', 'Щ' => 'Shch', 'Ы' => 'Y', 'Э' => 'E', 'Ю' => 'Yu',
  'Я' => 'Ya'
];

function transliterate(string $russianString): string
{
  global $transliterationMap;

  $englishString = '';
  for ($i = 0; $i < mb_strlen($russianString, 'UTF-8'); $i++) {
    $char = mb_substr($russianString, $i, 1, 'UTF-8');

    if (array_key_exists($char, $transliterationMap)) {
      $englishString .= $transliterationMap[$char];
    } else {
      $englishString .= $char;
    }
  }

  return $englishString;
}

echo transliterate('Привет');
echo "\n";
echo transliterate('Как дела?');