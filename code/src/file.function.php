<?php

function readAllFunction(array $config): string
{
  $address = $config['storage']['address'];

  if (file_exists($address) && is_readable($address)) {
    $file = fopen($address, "rb");

    $contents = '';

    while (!feof($file)) {
      $contents .= fread($file, 100);
    }

    fclose($file);
    return $contents;
  } else {
    return handleError("Файл не существует");
  }
}

function addFunction(array $config): string
{
  $address = $config['storage']['address'];

  $name = removeUnwantedChars(trim(readline("Введите имя: ")));
  if (!validateName($name)) {
    return handleError("Ошибка формата имени (имя должно быть от 1 по 255 символов). Данные не сохранены");
  }

  $date = trim(readline("Введите дату рождения в формате ДД.ММ.ГГГГ: "));
  if (!validateDate($date)) {
    return handleError("Ошибка формата даты. Данные не сохранены");
  }

  $data = $name . ", " . $date;
  $fileHandler = fopen($address, 'a');

  if (fwrite($fileHandler, $data . PHP_EOL)) {
    fclose($fileHandler);
    return "Запись $data добавлена в файл $address";
  } else {
    return handleError("Произошла ошибка записи. Данные не сохранены");
  }
}

function clearFunction(array $config): string
{
  $address = $config['storage']['address'];

  if (file_exists($address) && is_readable($address)) {
    $file = fopen($address, "w");

    fwrite($file, '');

    fclose($file);
    return "Файл очищен";
  } else {
    return handleError("Файл не существует");
  }
}

function helpFunction()
{
  return handleHelp();
}

function readConfig(string $configAddress): array|false
{
  return parse_ini_file($configAddress, true);
}

function readProfilesDirectory(array $config): string
{
  $profilesDirectoryAddress = $config['profiles']['address'];

  if (!is_dir($profilesDirectoryAddress)) {
    mkdir($profilesDirectoryAddress);
  }

  $files = scandir($profilesDirectoryAddress);

  $result = "";

  if (count($files) > 2) {
    foreach ($files as $file) {
      if (in_array($file, ['.', '..']))
        continue;

      $result .= $file . "\r\n";
    }
  } else {
    $result .= "Директория пуста \r\n";
  }

  return $result;
}

function readProfile(array $config): string
{
  $profilesDirectoryAddress = $config['profiles']['address'];

  if (!isset($_SERVER['argv'][2])) {
    return handleError("Не указан файл профиля");
  }

  $profileFileName = $profilesDirectoryAddress . $_SERVER['argv'][2] . ".json";

  if (!file_exists($profileFileName)) {
    return handleError("Файл $profileFileName не существует");
  }

  $contentJson = file_get_contents($profileFileName);
  $contentArray = json_decode($contentJson, true);

  $info = "Имя: " . $contentArray['name'] . "\r\n";
  $info .= "Фамилия: " . $contentArray['lastname'] . "\r\n";

  return $info;
}

function getBirthdays(array $config): string
{
  $address = $config['storage']['address'];
  $file = fopen($address, 'r');
  $searchBirthday = date('d.m');
  $currentDate = date('d.m.Y');
  $arrItem = [];

  if ($file) {
    while (($line = fgets($file)) !== false) {
      $line = trim($line);
      list($name, $date) = explode(', ', $line);

      $arrBirthday = explode('-', $date);
      $birthday = "$arrBirthday[0].$arrBirthday[1]";

      if ($searchBirthday == $birthday) {
        $arrItem[] = "$name $date";
      }
    }

    fclose($file);

    if (count($arrItem) > 0) return implode("\r\n", $arrItem);
    return "Дней рождения на дату $currentDate не найдено.";
  } else {
    return handleError("Не удалось открыть файл.");
  }
}

function getNearBirthdays(array $config): string
{
  $address = $config['storage']['address'];
  $file = fopen($address, 'r');
  $currentDate = new DateTime();
  $range = 10;
  // клонируем объект $currentDate и вызываем его метод modify для добавления $range дней
  $endDate = (clone $currentDate)->modify("+$range days");
  $arrItem = [];

  if ($file) {
    while (($line = fgets($file)) !== false) {
      $line = trim($line);
      list($name, $date) = explode(', ', $line);

      $arrBirthday = explode('-', $date);
      $month = (int)$arrBirthday[1];
      $day = (int)$arrBirthday[0];
      // создаем новый объект ДатыВремени
      $birthday = new DateTime();
      // вызываем метод установки даты в текущем году, но с месяцем и датой рождения
      $birthday->setDate(intval($currentDate->format('Y')), $month, $day);

      // Если дата рождения уже прошла в этом году, устанавливаем дату на следующий год
      if ($birthday < $currentDate) {
        $birthday->setDate(intval($currentDate->format('Y')) + 1, $month, $day);
      }

      if ($birthday >= $currentDate && $birthday <= $endDate) {
        $arrItem[] = "$name $date";
      }
    }

    fclose($file);

    if (count($arrItem) > 0) return implode("\r\n", $arrItem);
    return "Дней рождения в ближайшие $range дней не найдено.";
  } else {
    return handleError("Не удалось открыть файл.");
  }
}

function delFunction(array $config): string
{
  $address = $config['storage']['address'];

  $delName = removeUnwantedChars(trim(readline("Введите имя: ")));
  if (!validateName($delName)) {
    return handleError("Ошибка формата имени (имя должно быть от 1 по 255 символов). Данные не удалены");
  }

  $delDate = trim(readline("Введите дату рождения в формате ДД.ММ.ГГГГ: "));
  if (!validateDate($delDate)) {
    return handleError("Ошибка формата даты. Данные не удалены");
  }

  $fileContent = file($address);
  $found = false;

  $file = fopen($address, 'w');
  if ($file) {
    foreach ($fileContent as $line) {
      $line = trim($line);
      list($name, $date) = explode(', ', $line);

      if (strcasecmp($name, $delName) === 0 && strcasecmp($date, $delDate) === 0) {
        $found = true;
        continue;
      }

      fwrite($file, $line . PHP_EOL);
    }

    fclose($file);

    if ($found) {
      return "Запись с именем $delName и датой $delDate успешно удалена.";
    } else {
      return "Запись с именем $delName и датой $delDate не найдена.";
    }
  } else {
    return handleError("Не удалось открыть файл.");
  }
}